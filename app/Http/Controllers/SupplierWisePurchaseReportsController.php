<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierWisePurchaseReportsController extends Controller
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
        return view('reports.supplierwisepurchasereports.index');
    }

    public function fetch_data(Request $request)
    {
//        if($request->ajax())
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
        $data_return = DB::table('purchase_return_masters as prm')
            ->join('purchase_return_details as prd', 'prm.id', '=', 'prd.purchase_return_master_id')
            ->join('purchase_masters as pm2', 'prm.purchase_master_id', '=', 'pm2.id')
            ->join('suppliers as sp', 'pm2.suppliers_id', '=', 'sp.id')
            ->select(DB::raw('sp.id,sp.name,0 as amount,sum(prd.total_amount) as return_amount'))
            ->whereBetween('prm.return_date_ad', [$from_date, $to_date])
            ->where('pm2.company_infos_id',auth()->user()->company_infos_id)
            ->groupBy('sp.id','sp.name');

        $sub = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('suppliers as sp', 'pm.suppliers_id', '=', 'sp.id')
            ->select(DB::raw('sp.id,sp.name,sum(pd.total_amount) amount,0 as return_amount'))
            ->whereBetween('pm.received_date_ad', [$from_date, $to_date])
            ->where('pm.company_infos_id',auth()->user()->company_infos_id)
            ->groupBy('sp.id','sp.name')
            ->union($data_return);

        return $data = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->mergeBindings($sub)
            ->selectRaw('id, name, round(sum(amount),2) as amount, round(sum(return_amount),2) as return_amount,
            round(sum(amount)-sum(return_amount),2) as total')
            ->groupBy('id','name')
            ->get();
//        dd($data->toSql());
    }

    public function get_details_data(Request $request)
    {
        $supplier_id = (int)$request->supplier_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $data_purchase_return = DB::table('purchase_return_masters as prm')
            ->join('purchase_masters as pm', 'prm.purchase_master_id','=','pm.id')
            ->join('purchase_return_details as prd', 'prm.id', '=', 'prd.purchase_return_master_id')
            ->join('items as it', 'it.id', '=', 'prd.items_id')
            ->join('suppliers as sp', 'pm.suppliers_id', '=', 'sp.id')
            ->selectRaw('"r" as flag, prm.return_date_ad as received_date,prm.return_no as purchase_no,
            pm.supplier_bill_no,it.code,it.name as items_name,prd.edition,
            prd.return_qty as qty,prd.amount as rate,
            prd.dis_per,prd.vat,prd.total_amount,prm.created_at')
            ->whereBetween('return_date_ad', [$from_date, $to_date])
            ->where([
                ['pm.company_infos_id',auth()->user()->company_infos_id],
                ['sp.id','=',$supplier_id]
            ]);
        $sub = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('items as it', 'it.id', '=', 'pd.items_id')
            ->join('suppliers as sp', 'pm.suppliers_id', '=', 'sp.id')
            ->selectRaw('"p" as flag, pm.received_date_ad as received_date, pm.purchase_no,
                pm.supplier_bill_no,it.code,it.name as items_name,pd.edition,
                pd.qty,pd.amount as rate,pd.dis_per,pd.vat,
                pd.total_amount,pm.created_at')
            ->whereBetween('received_date_ad', [$from_date, $to_date])
            ->where([
                ['pm.company_infos_id',auth()->user()->company_infos_id],
                ['sp.id','=',$supplier_id]
                ])
            ->union($data_purchase_return);

        $data = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->mergeBindings($sub)
            ->selectRaw('flag,received_date,purchase_no,supplier_bill_no,code,items_name,
            edition,qty,rate,dis_per,vat,total_amount')
            ->orderByRaw('flag, created_at')
            ->get();

         return json_encode($data);
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
        $from_date = $request->from_date ?? Carbon::today()->toDateString();
        $to_date = $request->to_date ?? Carbon::today()->toDateString();
//        dd($request->report_type);
        if ($request->report_type == 'summary') {
            $supplier_details = $this->get_data($from_date, $to_date);
            return view('reports.supplierwisepurchasereports.print', compact('supplier_details', 'company_info', 'from_date', 'to_date'));
        } else {
//            dd("here");
            $supplier_details = $this->get_data($from_date, $to_date);
            return view('reports.supplierwisepurchasereports.printdetail', compact('supplier_details', 'company_info', 'from_date', 'to_date'));
        }
    }
}



