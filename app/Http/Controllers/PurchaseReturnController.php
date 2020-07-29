<?php

namespace App\Http\Controllers;

use App\FiscalYear;
use App\helpers\NepaliToEnglishDateConverter;
use App\IssueDetail;
use App\Item;
use App\PurchaseDetail;
use App\PurchaseMaster;
use App\PurchaseReturnDetail;
use App\PurchaseReturnMaster;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $purchase_returns = PurchaseReturnMaster::where('company_infos_id',auth()->user()->company_infos_id)->get();
//        dd($purchase_returns[0]);
//        dd($purchase_returns[0]->purchase_master->supplier);
        return view('purchase_returns.index',compact('purchase_returns'));
    }

    public function create($id)
    {
        $purchase_master = PurchaseMaster::findOrFail($id);
        $sub = DB::table('purchase_details as pd')
            ->leftJoin('purchase_return_details as prd', 'pd.id', '=', 'prd.purchase_detail_id')
            ->join('issue_details as id', 'pd.id', '=', 'id.purchase_details_id')
            ->select(DB::raw('pd.id, pd.items_id, pd.edition,pd.amount ,pd.discount,pd.dis_per,pd.vat,(pd.qty- IFNULL(prd.return_qty,0))qty,sum(id.cur_qty) cur_qty'))
            ->where([
                ['pd.purchase_masters_id',$purchase_master->id],
                ['pd.company_infos_id',auth()->user()->company_infos_id],
                ['id.to_dep_id',1],
            ])
            ->groupByRaw('pd.id, pd.items_id, pd.edition,pd.discount,pd.dis_per,pd.qty,prd.return_qty,pd.vat');

        $purchase_details = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->mergeBindings($sub)
            ->selectRaw('id, items_id , edition, amount , qty,cur_qty , discount ,dis_per ,vat,
                amount*cur_qty*(1-dis_per/100)*(1+vat/100) as total')
            ->where([
                ['qty','>=','cur_qty'],
                ['cur_qty','>',0],
            ])
            ->get();
//        dd($purchase_details);
        $fiscal_year = FiscalYear::where('status',1)->first();
        $purchase_return_no = $this->get_new_purchase_return_no();
        $items = Item::where('users_id',auth()->user()->id)->get();
        return view('purchase_returns.create',compact('purchase_master','items','fiscal_year','purchase_return_no','purchase_details'));
    }

    public function get_new_purchase_return_no(){
        $fiscal_year = FiscalYear::where('status',1)->first()->fiscal_year;
        $purchase_return_master = PurchaseReturnMaster::where([
                ['users_id', '=', auth()->user()->id],
                ['fiscal_year', '=', $fiscal_year]
            ])->orderby('id','desc')->first()->return_no ?? 0;
        $purchase_return_no = substr($purchase_return_master,7,13) + 1;
        $purchase_return_max_no   = sprintf("%06d", $purchase_return_no);
        $purchase_return_max_no = 'R'.$fiscal_year.'-'.$purchase_return_max_no;
        return $purchase_return_max_no;
    }


    public function store(Request $request)
    {



//        $data = request()->validate([
//            'supplier_bill_no' => ['required'],
//            'supplier_bill_date' => ['required'],
//            'purchase_no' => ['required'],
//            'received_date' => ['required'],
//            'received_by' => ['required'],
//            'sub_total' => ['required'],
//            'discount' => ['required'],
//            'total_vat' => ['required'],
//            'total_amount' => ['required'],
//            'grand_total' => ['required'],
//            'item' => ['required'],
//            'amount' => ['required'],
//            'qty' => ['required'],
//            'discount' => ['required'],
//            'vat' => ['required'],
//            'grand_total' => ['required']
//            //'image' => 'required|image'
//        ]);



//        dd($request->toArray());
//        dd($request->all());
        $fiscal_year = FiscalYear::where('status',1)->first()->fiscal_year;

        $nep_to_eng = new NepaliToEnglishDateConverter();
        $return_date_ad = $nep_to_eng->nep_to_eng_date_converter($request->return_date);
        $return_date = $nep_to_eng->nep_date_formatter($request->return_date);

        $issue_date_time = Carbon::parse(date('Y:m:d H:i:s'))->timezone('Asia/Kathmandu');
        $issue_time = substr($issue_date_time,11,19);

        $return_no = $this->get_new_purchase_return_no();

        DB::beginTransaction();
        try {
            $purchase_return_master = new PurchaseReturnMaster();
            $purchase_return_master->purchase_master_id = $request->purchase_master_id;
            $purchase_return_master->return_date = $return_date;
            $purchase_return_master->return_date_ad = $return_date_ad;
            $purchase_return_master->return_by = $request->return_by;
            $purchase_return_master->fiscal_year = $fiscal_year;
            $purchase_return_master->return_no = $return_no;
            $purchase_return_master->amount = $request->sub_total;
            $purchase_return_master->discount = $request->total_discount;
            $purchase_return_master->dis_per = $request->total_dis_per;
            $purchase_return_master->vat = $request->total_vat ?? 0;
            $purchase_return_master->total_amount = $request->grand_total;
            $purchase_return_master->users_id = auth()->user()->id;
            $purchase_return_master->company_infos_id = auth()->user()->company_infos_id;
            $purchase_return_master->save();

            $purchase_return_master_id = $purchase_return_master->id;
            //return redirect(route('publisher.index'));
            // save master and get id then


            $qtys = $request->get('qty');
            $purchase_detail_id = $request->get('purchase_detail_id');
//            dd($items);

            foreach ($qtys as $index => $qty) {
                $purchase_detail = PurchaseDetail::findOrFail($purchase_detail_id[$index]);
//                dd($purchase_detail->all());
                $detail = [];
                $detail['purchase_return_master_id'] = $purchase_return_master_id;
                $detail['purchase_detail_id'] = $purchase_detail->id;
                $detail['return_no'] = $return_no;
                $detail['items_id'] = $purchase_detail->items_id;
                $detail['edition'] = $purchase_detail->edition;
                $detail['amount'] = $purchase_detail->amount;
                $detail['qty'] = $qty;
                $detail['dis_per'] = $purchase_detail->dis_per ?? 0;
                $detail['discount'] = ($purchase_detail->dis_per ?? 0 / 100 * ($purchase_detail->amount * $qty));
                $detail['vat'] = $purchase_detail->vat;
                $detail['total'] = $purchase_detail->amount * $qty * (1 - $purchase_detail->dis_per / 100) * (1 + $purchase_detail->vat / 100);
                // create detail

                $purchase_return_detail = new PurchaseReturnDetail();
                $purchase_return_detail->purchase_return_master_id = $detail['purchase_return_master_id'];
                $purchase_return_detail->purchase_detail_id = $detail['purchase_detail_id'];
                $purchase_return_detail->return_no = $detail['return_no'];
                $purchase_return_detail->items_id = $detail['items_id'];
                $purchase_return_detail->edition = $detail['edition'];
                $purchase_return_detail->amount = $detail['amount'];
                $purchase_return_detail->return_qty = $detail['qty'];
                $purchase_return_detail->discount = $detail['discount'];
                $purchase_return_detail->dis_per = $detail['dis_per'] ?? 0;
                $purchase_return_detail->vat = $detail['vat'] ?? 0;
                $purchase_return_detail->total_amount = $detail['total'];
                $purchase_return_detail->users_id = auth()->user()->id;
                $purchase_return_detail->company_infos_id = auth()->user()->company_infos_id;
                $purchase_return_detail->save();
//                dd("here");


//                purchase_return_details_id = PurchaseDetail::latest()->first()->id;
//                $purchase_return_details_id = $purchase_return_detail->id;

                $issue_details = IssueDetail::where([
                    ['purchase_details_id', $detail['purchase_detail_id']],
                    ['to_dep_id', 1],
                ])
                    ->orderBy('id', 'DESC')
                    ->get();

                $return_qty = $detail['qty'];

//                dd($return_qty);
                foreach ($issue_details as $issue_detail) {
                    if ($return_qty > 0) {
                        $save_issue_detail = IssueDetail::findOrFail($issue_detail->id);
                        if ($issue_detail->cur_qty >= $return_qty) {
                            $save_issue_detail->cur_qty = $save_issue_detail->cur_qty - $detail['qty'];
                        }
                        else {
                            $save_issue_detail->cur_qty = 0;
                            $return_qty -= $save_issue_detail->cur_qty;
                        }
                        $save_issue_detail->save();
                    }

                }

            }

            DB::commit();

        } catch (Throwable $e) {
            DB::rollback();
            report($e);

            return false;
        }
        return redirect(route('purchase.return.index'));

    }

    public function print_purchase($id)
    {
        $purchase_return_master = PurchaseReturnMaster::findorfail($id);
        $purchase_return_details = PurchaseReturnDetail::where('purchase_return_master_id',$id)->get();
        $company_info = auth()->user()->company_info;
        //dd($purchase_return_master);
        return view('purchase_returns.print1',compact('purchase_master','purchase_details','company_info'));

    }
}
