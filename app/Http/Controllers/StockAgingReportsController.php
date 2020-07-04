<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StockAgingReportsController extends Controller
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
//        $this->fetch_data($request);
        return view('reports.stockreports.agingreports.index');
    }

    public function fetch_data(Request $request)
    {
        $today_date = Carbon::now();
        $date1 = $today_date->toDateString();
        $date_30days = Carbon::now()->subDays($request->range_day_one ?? 30);
        $date2 = $date_30days->toDateString();
        $date_60days = Carbon::now()->subDays($request->range_day_two ?? 60);
        $date3 = $date_60days->toDateString();
        $date_90days = Carbon::now()->subDays($request->range_day_three ?? 90);
        $date4 = $date_90days->toDateString();
//        dd($date1,$date2,$date3,$date4);
        $data = $this->get_data($date1,$date2,$date3,$date4);
//        return $data;
        return datatables()->of($data)->make(true);
    }

    public function get_data($date1,$date2,$date3,$date4)
    {

        $data_first = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('items as it', 'pd.items_id', '=', 'it.id')
            ->join('issue_details as isd',[[ 'pd.id', '=', 'isd.purchase_details_id'],])
            ->select('it.code','it.name as items_name','pd.edition',DB::raw('sum(isd.cur_qty) as cur_qty'),
                DB::raw('0 as qty1 , 0 as amount1,sum(isd.cur_qty) as qty2,(pd.amount*sum(isd.cur_qty)*(1-pd.dis_per/100)*(1+pd.vat/100)) as amount2,0 as qty3, 0 as amount3, 0 as qty4, 0 as amount4'))
            ->whereBetween('pm.received_date_ad', [$date3,$date2])
            ->where([
                ['pm.company_infos_id',auth()->user()->company_infos_id],
                [DB::raw('(isd.cur_qty)'), '>' , 0],
                ['isd.company_infos_id','=',auth()->user()->company_infos_id],
                ['isd.to_dep_id','=',1]
            ])
            ->groupBy('it.code', 'it.name', 'pd.edition','pd.amount','pd.dis_per','pd.vat');

        $data_second = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('items as it', 'pd.items_id', '=', 'it.id')
            ->join('issue_details as isd', 'pd.id', '=', 'isd.purchase_details_id')
            ->select('it.code','it.name as items_name','pd.edition',DB::raw('sum(isd.cur_qty) as cur_qty'),
                DB::raw('0 as qty1, 0 as amount1, 0 as qty2, 0 as amount2,sum(isd.cur_qty) as qty3,(pd.amount*sum(isd.cur_qty)*(1-pd.dis_per/100)*(1+pd.vat/100)) as amount3,0 as qty4, 0 as amount4'))
            ->whereBetween('pm.received_date_ad', [$date4, $date3])
            ->where([
                ['pm.company_infos_id',auth()->user()->company_infos_id],
                [DB::raw('(isd.cur_qty)'), '>' , 0],
                ['isd.company_infos_id','=',auth()->user()->company_infos_id],
                ['isd.to_dep_id','=',1]
            ])
            ->groupBy('it.code', 'it.name', 'pd.edition','pd.amount','pd.dis_per','pd.vat');

        $data_third = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('items as it', 'pd.items_id', '=', 'it.id')
            ->join('issue_details as isd', 'pd.id', '=', 'isd.purchase_details_id')
            ->select('it.code','it.name as items_name','pd.edition',DB::raw('sum(isd.cur_qty) as cur_qty'),
                DB::raw('0 as qty1, 0 as amount1, 0 as qty2, 0 as amount2, 0 as qty3, 0 as amount3,sum(isd.cur_qty) as qty4,(pd.amount*sum(isd.cur_qty)*(1-pd.dis_per/100)*(1+pd.vat/100)) as amount4'))
            ->where([
                ['pm.received_date_ad', '<' , $date4],
                [DB::raw('(isd.cur_qty)'), '>' , 0],
                ['isd.company_infos_id','=',auth()->user()->company_infos_id],
                ['isd.to_dep_id','=',1]
                ])
            ->where('pm.company_infos_id',auth()->user()->company_infos_id)
            ->groupBy('it.code', 'it.name', 'pd.edition','pd.amount','pd.dis_per','pd.vat');

//        dd(auth()->user()->company_infos_id);
        $sub = DB::table('purchase_masters as pm')
            ->join('purchase_details as pd', 'pm.id', '=', 'pd.purchase_masters_id')
            ->join('items as it', 'pd.items_id', '=', 'it.id')
            ->join('issue_details as isd', 'pd.id', '=', 'isd.purchase_details_id')
            ->select('it.code','it.name as items_name','pd.edition',DB::raw('sum(isd.cur_qty) as cur_qty'),
                DB::raw('sum(isd.cur_qty) as qty1,(pd.amount*sum(isd.cur_qty)*(1-pd.dis_per/100)*(1+pd.vat/100)) as amount1,0 as qty2, 0 as amount2, 0 as qty3, 0 as amount3, 0 as qty4, 0 as amount4'))
            ->whereBetween('pm.received_date_ad', [$date2, $date1])
            ->where([
                ['pm.company_infos_id',auth()->user()->company_infos_id],
                [DB::raw('(isd.cur_qty)'), '>' , 0],
                ['isd.company_infos_id','=',auth()->user()->company_infos_id],
                ['isd.to_dep_id','=',1]
            ])
            ->groupBy('it.code', 'it.name', 'pd.edition','pd.amount','pd.dis_per','pd.vat')
        ->union($data_first)
        ->union($data_second)
        ->union($data_third);

//      If we remove alias from DB::raw() below we can get query in the error
//        return $data = DB::table(DB::raw("({$sub->toSql()})"))
          $data = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->mergeBindings($sub)
            ->selectRaw('code, items_name, edition, sum(qty1) as qty1, round(sum(amount1),2) as amount1,
            sum(qty2) as qty2, sum(amount2) as amount2,
            sum(qty3) as qty3, sum(amount3) as amount3,
            sum(qty4) as qty4, sum(amount4) as amount4,
            sum(qty1 + qty2 + qty3 + qty4) as qty5, round(sum(amount1 + amount2 + amount3 + amount4),2) as amount5')
//            ->selectRaw('code, items_name, edition, sum(qty1) as qty1, sum(amount1) as amount1,
//            sum(qty2) as qty2, sum(amount2) as amount2,
//            sum(qty3) as qty3, sum(amount3) as amount3,
//            sum(qty4) as qty4, sum(amount4) as amount4,
//            sum(qty1 + qty2 + qty3 + qty4) as qty5, sum(amount1 + amount2 + amount3 + amount4) as amount5')
            ->groupBy('code', 'items_name', 'edition')
//            ->toSql();
        ->get();

        return $data;
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
