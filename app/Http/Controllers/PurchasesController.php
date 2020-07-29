<?php

namespace App\Http\Controllers;

use App\FiscalYear;
use App\helpers\DateHelper;
use App\helpers\NepaliToEnglishDateConverter;
use App\IssueDetail;
use App\Item;
use App\ItemsManagement;
use App\PurchaseDetail;
use App\PurchaseMaster;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $purchases = PurchaseMaster::where('company_infos_id',auth()->user()->company_infos_id)->get();
        return view('purchases.index',compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::where('company_infos_id',auth()->user()->company_infos_id)->get();
        $fiscal_year = FiscalYear::where('status',1)->first();
        $purchase_no = $this->get_new_purchase_no();
        $items = Item::where('users_id',auth()->user()->id)->get();
        return view('purchases.create',compact('suppliers','items','fiscal_year','purchase_no'));
    }

    public function get_new_purchase_no(){
        $fiscal_year = FiscalYear::where('status',1)->first()->fiscal_year;
        $purchase_master = PurchaseMaster::where([
        ['users_id', '=', auth()->user()->id],
        ['fiscal_year', '=', $fiscal_year]
        ])->orderby('id','desc')->first()->purchase_no ?? 0;
        $purchase_no = substr($purchase_master,7,13) + 1;
        $purchase_max_no   = sprintf("%06d", $purchase_no);
        $purchase_no_max = 'P'.$fiscal_year.'-'.$purchase_max_no;
        return $purchase_no_max;
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



        $purchase_no = $this->get_new_purchase_no();
        if ( ! isset($request['is_payment_done']) )
            $request['is_payment_done'] = 'N';
        else
            $request['is_payment_done'] = 'Y';

//        dd($request->toArray());
        $fiscal_year = FiscalYear::where('status',1)->first()->fiscal_year;

        $nep_to_eng = new NepaliToEnglishDateConverter();
        $supplier_date_ad = $nep_to_eng->nep_to_eng_date_converter($request->supplier_bill_date);
        $supplier_date = $nep_to_eng->nep_date_formatter($request->supplier_bill_date);

//        $supplier_date_array = explode('-', $request->supplier_bill_date);
//
//        $bsObj = new DateHelper();
//        $data_ad_array = $bsObj->nep_to_eng($supplier_date_array[0],$supplier_date_array[1],$supplier_date_array[2]);
//        $supplier_date_ad = $data_ad_array['year'] .'-'. $data_ad_array['month'] .'-'.$data_ad_array['date'];

        $received_date_ad = $nep_to_eng->nep_to_eng_date_converter($request->received_date);;
        $received_date = $nep_to_eng->nep_date_formatter($request->received_date);
//        dd($received_date,$received_date_ad);

        $issue_date_time = Carbon::parse(date('Y:m:d H:i:s'))->timezone('Asia/Kathmandu');
        $issue_time = substr($issue_date_time,11,19);

        DB::beginTransaction();
        try {
            $purchase_master = new PurchaseMaster();
            $purchase_master->suppliers_id = $request->suppliers_id;
            $purchase_master->supplier_bill_no = $request->supplier_bill_no;
            $purchase_master->supplier_bill_date = $supplier_date;
            $purchase_master->supplier_bill_date_ad = $supplier_date_ad;
            $purchase_master->fiscal_year = $fiscal_year;
            $purchase_master->purchase_no = $purchase_no;
            $purchase_master->received_date = $received_date;
            $purchase_master->received_date_ad = $received_date_ad;
            $purchase_master->received_by = $request->received_by;
            $purchase_master->is_payment_done = $request->is_payment_done;
            $purchase_master->amount = $request->sub_total;
            $purchase_master->discount = $request->total_discount;
            $purchase_master->dis_per = $request->total_dis_per;
            $purchase_master->vat = $request->total_vat ?? 0;
            $purchase_master->total_amount = $request->grand_total;
            $purchase_master->users_id = auth()->user()->id;
            $purchase_master->company_infos_id = auth()->user()->company_infos_id;
            $purchase_master->save();

            $purchase_master_id = $purchase_master->id;
            //return redirect(route('publisher.index'));
            // save master and get id then

            $items = $request->get('item');
            $editions = $request->get('edition');
            $amounts = $request->get('amount');
            $qtys = $request->get('qty');
            $discounts = $request->get('discount');
            $vats = $request->get('vat');
//            dd($discounts);

            foreach ($items as $index => $item) {
                $detail = [];
                $detail['purchase_master_id'] = $purchase_master_id;
                $detail['purchase_no'] = $purchase_no;
                $detail['items_id'] = $item;
                $detail['edition'] = $editions[$index];
                $detail['amount'] = $amounts[$index];
                $detail['qty'] = $qtys[$index];
                $detail['dis_per'] = $discounts[$index];
//                $detail['discount'] = $discounts[$index];
//                dd($discounts[$index]>0,$discounts[$index],$amounts[$index],$qtys[$index],($discounts[$index]/($amounts[$index]*$qtys[$index])));
                if ($discounts[$index]>0) {
                    $detail['discount'] = ($discounts[$index]/100*($amounts[$index]*$qtys[$index]));
                }
                else {
                    $detail['discount'] = 0;
                }
                $detail['vat'] = $vats[$index];
                $detail['total'] = $amounts[$index]*$qtys[$index]*(1-$discounts[$index]/100)*(1+$vats[$index]/100);
//                dd($detail);
                // create detail

                $purchase_detail = new PurchaseDetail();
                $purchase_detail->purchase_masters_id = $detail['purchase_master_id'];
                $purchase_detail->purchase_no = $detail['purchase_no'];
                $purchase_detail->items_id = $detail['items_id'];
                $purchase_detail->edition = $detail['edition'];
                $purchase_detail->amount = $detail['amount'];
                $purchase_detail->qty = $detail['qty'];
                $purchase_detail->discount = $detail['discount'];
                $purchase_detail->dis_per = $detail['dis_per'] ?? 0;
                $purchase_detail->vat = $detail['vat'] ?? 0;
                $purchase_detail->total_amount = $detail['total'];
                $purchase_detail->users_id = auth()->user()->id;
                $purchase_detail->company_infos_id = auth()->user()->company_infos_id;
                $purchase_detail->save();

//                $purchase_details_id = PurchaseDetail::latest()->first()->id;
                $purchase_details_id = $purchase_detail->id;

                $issue_detail = new IssueDetail();
                $issue_detail->items_id = $detail['items_id'];
                $issue_detail->edition = $detail['edition'];
                $issue_detail->qty = $detail['qty'];
                $issue_detail->cur_qty = $detail['qty'];
                $issue_detail->purchase_details_id = $purchase_details_id;
                $issue_detail->issue_date = $received_date;
                $issue_detail->issue_date_ad = $received_date_ad;
                $issue_detail->issue_time = $issue_time;
                $issue_detail->ids_id = 0;
                $issue_detail->from_dep_id = 1;
                $issue_detail->to_dep_id = 1;
                $issue_detail->fiscal_year = $fiscal_year;
                $issue_detail->transaction_type = 'PURCHASE';
                $issue_detail->users_id = auth()->user()->id;
                $issue_detail->company_infos_id = auth()->user()->company_infos_id;
                $issue_detail->save();
            }

            DB::commit();
            return redirect(route('purchase.index'));
        } catch (Throwable $e) {
            DB::rollback();
            report($e);

            return false;
        }

    }

    public function print_purchase($id)
    {
        $purchase_master = PurchaseMaster::findorfail($id);
        $purchase_details = PurchaseDetail::where('purchase_masters_id',$id)->get();
        $company_info = auth()->user()->company_info;
        //dd($purchase_master);
        return view('purchases.print1',compact('purchase_master','purchase_details','company_info'));

    }

}
