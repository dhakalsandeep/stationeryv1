{{--<input type="button" onclick="tableToExcel('tablename', 'name', 'myfile.xls')" value="Export to Excel">--}}
@extends('layouts.adminReport')
@section('styles')
    <style>
        table tr td {
            padding: 0 0.5%;
        }
    </style>
@stop
<!-- Content Wrapper. Contains page content -->
@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="panel panel-primary">
            <div class="panel-body">
                <table width="90%" style="margin-left: 5%;" class="table">
                    <thead>
                        <tr><th style="text-align: center;width: 100%;font-weight: bold;font-size: 25px;">{{  $company_info->name }}</th></tr>
                        <tr><th style="text-align: center;width: 100%">{{  $company_info->address }}</th></tr>
                        <tr><th style="text-align: center;width: 100%">Stock Aging Report</th></tr>
                        <tr><th style="text-align: center;width: 100%">Print Date : {{ Carbon\Carbon::today()->toDateString()  }}</th></tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-body" style="margin: 0 5%">
                <table border="1" width="100%"  class="table table-bordered" id="stockAgingTable"
                       style="background-color:#dbdbdb; font-size: 16px">
                    <thead class="text-center">
                    <tr>
                        <th rowspan="2"  style="vertical-align: middle;">SN</th>
                        <th rowspan="2"  style="vertical-align: middle;">Code</th>
                        <th rowspan="2"  style="vertical-align: middle;">Items Name</th>
                        <th rowspan="2"  style="vertical-align: middle;">Edition</th>
                        <th colspan="2" id="day_range_one">0 - {{ $range_days[0] }} Days</th>
                        <th colspan="2" id="day_range_two">{{ $range_days[0] }} - {{ $range_days[1] }} Days</th>
                        <th colspan="2" id="day_range_three">{{ $range_days[1] }} - {{ $range_days[2] }} Days</th>
                        <th colspan="2" id="day_range_four">Above {{ $range_days[2] }} Days</th>
                        <th colspan="2">Balance</th>
                    </tr>
                    <tr>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($aging_details as $key =>$aging_detail)
                        <tr style="background-color: white;">
                            <td style="text-align: right"><span>{{++$key}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->code}}</td>
                            <td style="text-align: left"><span>{{$aging_detail->items_name}}</td>
                            <td style="text-align: left;"><span>{{$aging_detail->edition}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->qty1}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->amount1}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->qty2}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->amount2}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->qty3}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->amount3}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->qty4}}</td>
                            <td style="text-align: right"><span>{{$aging_detail->amount4}}</span></td>
                            <td style="text-align: right"><span>{{$aging_detail->qty5}}</span></td>
                            <td style="text-align: right;"><span >{{$aging_detail->amount5}}</span></td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="13" style="text-align: right"><span>Total :</span></td>
                            <td colspan="1" style="text-align: right" id="totalAmount"><span>Total</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>

    </section>
</div>
@endsection

@section('scripts')
{{-- Download Excel --}}
<script>
    var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) };
        return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById('billDetailTable');
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML };

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();

        }
    })()

    let sumTotal,columnCount,stockAgingTable;
    sumTotal = 0;
    stockAgingTable = document.getElementById('stockAgingTable');
    columnCount = stockAgingTable.rows[2].cells.length;
    for (let i =2; i < stockAgingTable.rows.length-1; i++) {
        sumTotal += parseFloat(stockAgingTable.rows[i].cells[columnCount-1].innerText);
        console.log(sumTotal);
    }
    document.getElementById("totalAmount").innerHTML = `<span>${sumTotal.toFixed(2)}<span>` ;
</script>
@endsection
