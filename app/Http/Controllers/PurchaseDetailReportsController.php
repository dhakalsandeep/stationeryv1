<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseDetailReportsController extends Controller
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
        return view('reports.purchasereports.index');
    }

    public function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != '' && $request->to_date != '')
            {
                $data = $this->get_data($request->from_date,$request->to_date);
            }
            else
            {
                $from_date = Carbon::now();
                $from_date = $from_date->toDateString();
                $data = $this->get_data($from_date,$from_date);
            }
            return datatables()->of($data)->make(true);
        }
    }

    public function get_data($from_date, $to_date)
    {
        return $data = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('items as it', 'pd.items_id', '=', 'it.id')
            ->join('items_types as itt', 'it.items_types_id', '=', 'itt.id')
            ->join('suppliers as sp', 'pm.suppliers_id', '=', 'sp.id')
            ->select('pm.received_date_ad as received_date', 'pm.purchase_no',
                'pm.supplier_bill_no','it.code','it.name as items_name','itt.type',
                'sp.name as supplier_name','pd.qty','pd.amount as rate','pd.dis_per','pd.vat',
                'pd.total_amount',DB::raw("'' as check_box"))
            ->whereBetween('received_date_ad', [$from_date, $to_date])
            ->where('pm.company_infos_id',auth()->user()->company_infos_id)
            ->orderBy('pm.created_at', 'asc')
            ->get();
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
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $purchase_details = $this->get_data($from_date,$to_date);
        return view('reports.purchasereports.print',compact('purchase_details','company_info','from_date','to_date'));
    }
}
