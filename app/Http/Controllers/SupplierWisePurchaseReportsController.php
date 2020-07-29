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
        $data_return = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('suppliers as sp', 'pm.suppliers_id', '=', 'sp.id')
            ->select(DB::raw('sp.id,sp.name,0 as amount,sum(pd.total_amount) as return_amount'))
            ->whereBetween('received_date_ad', [$from_date, $to_date])
            ->where('pm.company_infos_id',auth()->user()->company_infos_id)
            ->groupBy('sp.id','sp.name');

        $sub = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('suppliers as sp', 'pm.suppliers_id', '=', 'sp.id')
            ->select(DB::raw('sp.id,sp.name,sum(pd.total_amount) amount,0 as return_amount'))
            ->whereBetween('received_date_ad', [$from_date, $to_date])
            ->where('pm.company_infos_id',auth()->user()->company_infos_id)
            ->groupBy('sp.id','sp.name')
            ->union($data_return);

        return  $data = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->mergeBindings($sub)
            ->selectRaw('id, name, round(sum(amount),2) as amount, round(sum(return_amount),2) as return_amount,
            round(sum(amount)-sum(return_amount)) as total')
            ->groupBy('id','name')
            ->get();
    }

    public function get_details_data(Request $request)
    {
        $supplier_id = (int)$request->supplier_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
//        dd($from_date, $to_date,$supplier_id);
         $data = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('items as it', 'it.id', '=', 'pd.items_id')
            ->join('suppliers as sp', 'pm.suppliers_id', '=', 'sp.id')
            ->select('pm.received_date_ad as received_date', 'pm.purchase_no',
                'pm.supplier_bill_no','it.code','it.name as items_name','pd.edition',
                'pd.qty','pd.amount as rate','pd.dis_per','pd.vat',
                'pd.total_amount')
            ->whereBetween('received_date_ad', [$from_date, $to_date])
            ->where([
                ['pm.company_infos_id',auth()->user()->company_infos_id],
                ['sp.id','=',$supplier_id]
                ])
            ->get();

//         dd(json_encode($data));
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



