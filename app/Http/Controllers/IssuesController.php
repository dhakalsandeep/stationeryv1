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
        $issues = IssueDetail::where('company_infos_id',auth()->user()->company_infos_id)->get();
        return view('issues.index',compact('issues'));
    }

    public function create()
    {
//        dd(auth()->user()->roles[0]);
        $stocks = IssueDetail::where([
            ['company_infos_id','=',auth()->user()->company_infos_id],
            ['to_dep_id','=',1],
            ['cur_qty','>','0']
        ])->orderby('created_at','desc')->get();
        $fiscal_year = FiscalYear::where('status',1)->first();
        $departments = Department::all();
        return view('issues.create',compact('stocks','fiscal_year','departments'));
    }

    public function get_items_edition(Request $request,$issue_details_id)
    {
        $issue_detail = IssueDetail::where('id',$issue_details_id)->first();
        return json_encode($issue_detail);
    }

    public function store(Request $request)
    {
        $issue_date_time = Carbon::parse(date('Y:m:d H:i:s'))->timezone('Asia/Kathmandu');
        $issue_time = substr($issue_date_time,11,19);
        $nep_to_eng = new NepaliToEnglishDateConverter();
        $issue_date_ad = $nep_to_eng->nep_to_eng_date_converter($request->issue_date);


        $fiscal_year = FiscalYear::where('status',1)->first()->fiscal_year;
        $from_department_id = $request->from_department_id;
        $to_department_id = $request->to_department_id;
        if ($from_department_id == 1) {
            $transaction_type = "ISSUE";
        }
        elseif ($from_department_id ==2 ) {
            $transaction_type = "ISSUE-BACK";
        }
        $issue_date = $nep_to_eng->nep_date_formatter($request->issue_date);
        $issue_details_ids = $request->get('issue_details_id');
        $qtys = $request->get('qty');

        DB::beginTransaction();

        try {
            foreach ($issue_details_ids as $index => $issue_details_id) {
                $detail = [];
                $detail['qty'] = $qtys[$index];

                $prev_issue_details = IssueDetail::findOrFail($issue_details_id);
                $prev_issue_details->cur_qty = $prev_issue_details->cur_qty - $qtys[$index];
                $prev_issue_details->save();

                $issue_detail = new IssueDetail();
                $issue_detail->fiscal_year = $fiscal_year;
                $issue_detail->transaction_type = $transaction_type;
                $issue_detail->issue_date = $issue_date;
                $issue_detail->issue_date_ad = $issue_date_ad;
                $issue_detail->issue_time = $issue_time;
                $issue_detail->ids_id = $prev_issue_details->id;
                $issue_detail->from_dep_id = $from_department_id;
                $issue_detail->to_dep_id = $to_department_id;
                $issue_detail->items_id = $prev_issue_details->items_id;
                $issue_detail->purchase_details_id = $prev_issue_details->purchase_details_id;
                $issue_detail->edition = $prev_issue_details->edition;
                $issue_detail->qty = $detail['qty'];
                $issue_detail->cur_qty = $detail['qty'];
                $issue_detail->users_id = auth()->user()->id;
                $issue_detail->company_infos_id = auth()->user()->company_infos_id;
                $issue_detail->save();
            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect(route('issue.index'));
    }

}
