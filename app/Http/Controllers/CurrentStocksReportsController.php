<?php

namespace App\Http\Controllers;

use App\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrentStocksReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function index(Request $request)
    {
        $departments = Department::all();
        return view('reports.stockreports.currentstocks.index',compact('departments'));

    }

    public function fetch_data(Request $request)
    {
//        dd($request->department_id,$request->report_type);
        if($request->ajax())
        {
            if($request->department_id != '' && $request->report_type != '')
            {
                $data = $this->get_data($request->department_id,$request->report_type);
            }
//            return json_encode($data);
            return datatables()->of($data)->make(true);
        }
    }

    public function get_data($department_id, $report_type)
    {
        $sub = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('items as it', 'pd.items_id', '=', 'it.id')
            ->join('items_types as itt', 'itt.id', '=', 'it.items_types_id')
            ->join('issue_details as isd', 'pd.id', '=', 'isd.purchase_details_id')
            ->select('it.code','it.name as items_name','pd.edition','itt.type',DB::raw('sum(isd.cur_qty) as current_stock'),
                DB::raw('it.ro_level as ro_level, pd.amount as rate,pd.dis_per,pd.vat,round((pd.amount*sum(isd.cur_qty)*(1-pd.dis_per/100)*(1+pd.vat/100)),2) as total_amount'))
            ->where([
                ['pm.company_infos_id',auth()->user()->company_infos_id],
                [DB::raw('(isd.cur_qty)'), '>' , 0],
                ['isd.company_infos_id','=',auth()->user()->company_infos_id],
                ['isd.to_dep_id','=',$department_id]
            ])
            ->groupBy('it.code', 'it.name', 'pd.edition','it.ro_level','itt.type','pd.amount','pd.dis_per','pd.vat');
        if ($report_type == 1) {
            return $data = $sub->get();
        }
        else {
            return  $data = DB::table(DB::raw("({$sub->toSql()}) as sub"))
                ->mergeBindings($sub)
                ->selectRaw('code,items_name, edition,type, current_stock , ro_level ,rate,dis_per ,vat,total_amount')
                ->whereRaw('current_stock < ro_level')
                ->get();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Print purchase detail report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function print_purchase_detail_report(Request $request)
    {
        $company_info = auth()->user()->company_info;
        $department_id = $request->department_id;
        $report_type = $request->report_type;
        if ($report_type ==1) {
            $report_title = "Current Stock Detail";
        }
        else
        {
            $report_title = "Current Stock Below Re-Order Level";
        }
        $current_stocks = $this->get_data($department_id,$report_type);
//        dd($current_stocks);
        return view('reports.stockreports.currentstocks.print',compact('current_stocks','company_info','department_id','report_title'));
    }
}
