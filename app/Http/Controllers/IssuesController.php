<?php

namespace App\Http\Controllers;

use App\Department;
use App\FiscalYear;
use App\helpers\DateHelper;
use App\helpers\NepaliToEnglishDateConverter;
use App\IssueDetail;
use App\Item;
use App\ItemsManagement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssuesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$issues = IssueDetail::where('users_id',auth()->user()->id)->get();
        $issues = IssueDetail::where('company_infos_id',auth()->user()->company_infos_id)->get();
        //dd($issues[0]->item->name);
        return view('issues.index',compact('issues'));
    }

    public function create()
    {
        $stocks = IssueDetail::where([['company_infos_id','=',auth()->user()->company_infos_id],
            ['to_dep_id','=',1],
                 ['cur_qty','>','0']])->orderby('created_at','desc')->get();
//        $items_management = ItemsManagement::with('issue_details')->get();
//        dd($stocks);
        //dd($stocks);
        $fiscal_year = FiscalYear::where('status',1)->first();
        $departments = Department::all();
        //dd($departments);
        return view('issues.create',compact('stocks','fiscal_year','departments'));
    }

    public function get_items_edition(Request $request,$issue_details_id)
    {
//        $items_management = ItemsManagement::where('id',$items_managements_id)->first();
        $issue_detail = IssueDetail::where('id',$issue_details_id)->first();
        return json_encode($issue_detail);
    }

    public function update_items_management($id,$qty,$from_dep_id)
    {
        //dd("here");
        $items_management = ItemsManagement::findorfail($id);
        if ($from_dep_id == 1) {
            $cur_qty = $items_management->cur_qty - $qty;
        }
        else {
            $cur_qty = $items_management->cur_qty + $qty;
        }
        $items_management->cur_qty = $cur_qty;
        //dd($items_management);
        $items_management->save();
    }

    public function store(Request $request)
    {
        $issue_date_time = Carbon::parse(date('Y:m:d H:i:s'))->timezone('Asia/Kathmandu');
        $issue_time = substr($issue_date_time,11,19);

//        $date_array = explode('-', $request->issue_date);
//
//        $bsObj = new DateHelper();
//        $data_ad_array = $bsObj->nep_to_eng($date_array[0],$date_array[1],$date_array[2]);
//        $issue_date_ad = $data_ad_array['year'] .'-'. $data_ad_array['month'] .'-'.$data_ad_array['date'];
//
        $nep_to_eng = new NepaliToEnglishDateConverter();
        $issue_date_ad = $nep_to_eng->nep_to_eng_date_converter($request->issue_date);


        $fiscal_year = FiscalYear::where('status',1)->first()->fiscal_year;
        $from_department_id = $request->from_department_id;
        $to_department_id = $request->to_department_id;
        $issue_date = $nep_to_eng->nep_date_formatter($request->issue_date);
        $items_managements_ids = $request->get('items_management_id');
        $editions = $request->get('edition');
        $qtys = $request->get('qty');

        DB::beginTransaction();

        try {
            foreach ($items_managements_ids as $index => $items_managements_id) {
                $items_management = ItemsManagement::where('id',$items_managements_id)->first();
                $detail = [];
                $detail['fiscal_year'] = $fiscal_year;
                $detail['issue_date'] = $issue_date;
                $detail['issue_date_ad'] = $issue_date_ad;
                $detail['issue_time'] = $issue_time;
                $detail['items_managements_id'] = $items_managements_id;
                $detail['items_id'] = $items_management->items_id;
                $detail['purchase_details_id'] = $items_management->purchase_details_id;
                $detail['edition'] = $editions[$index];
                $detail['qty'] = $qtys[$index];

                $issue_detail = new IssueDetail();
                $issue_detail->fiscal_year = $detail['fiscal_year'];
                $issue_detail->issue_date = $detail['issue_date'];
                $issue_detail->issue_date_ad = $detail['issue_date_ad'];
                $issue_detail->issue_time = $detail['issue_time'];
                $issue_detail->from_dep_id = $from_department_id;
                $issue_detail->to_dep_id = $to_department_id;
                $issue_detail->items_managements_id = $detail['items_managements_id'];
                $issue_detail->items_id = $detail['items_id'];
                $issue_detail->purchase_details_id = $detail['purchase_details_id'];
                $issue_detail->edition = $detail['edition'];
                $issue_detail->qty = $detail['qty'];
                $issue_detail->cur_qty = $detail['qty'];
                $issue_detail->users_id = auth()->user()->id;
                $issue_detail->company_infos_id = auth()->user()->company_infos_id;
                $issue_detail->save();

                $this->update_items_management($detail['items_managements_id'],$detail['qty'],$from_department_id);

            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return redirect(route('issue.index'));
    }

}
