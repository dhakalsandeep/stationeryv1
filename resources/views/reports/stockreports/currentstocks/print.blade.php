{{--<input type="button" onclick="tableToExcel('tablename', 'name', 'myfile.xls')" value="Export to Excel">--}}
@extends('layouts.adminReport')
@section('styles')
    <style>
        table tr td,table tr th {
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
                        <tr><th style="text-align: center;width: 100%">{{ $report_title }}</th></tr>
                        <tr><th style="text-align: center;width: 100%">Print Date : {{ \Carbon\Carbon::today()->toDateString() }} </th></tr>
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
                <table border="1" width="100%"  class="table table-bordered" id="purchaseDetailTable"
                       style="background-color:#dbdbdb; font-size: 16px;margin-top: 1%;">
                    <thead>
                    <tr>
                        <th style="width: 5%">S. No.</th>
                        <th>Code</th>
                        <th>Item Name</th>
                        <th>Edition</th>
                        <th>Item Type</th>
                        <th>Current Stock</th>
                        <th>R.O. Level</th>
                        <th>Rate</th>
                        <th>Discount(%)</th>
                        <th>VAT(%)</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($current_stocks as $key =>$current_stock)
                        <tr style="background-color: white;">
                            <td style="text-align: right"><span>{{++$key}}</td>
                            <td style="text-align: left"><span>{{$current_stock->code}}</td>
                            <td style="text-align: left"><span>{{$current_stock->items_name}}</td>
                            <td style="text-align: left"><span>{{$current_stock->edition}}</td>
                            <td style="text-align: left"><span>{{$current_stock->type}}</td>
                            <td style="text-align: right"><span>{{$current_stock->current_stock}}</td>
                            <td style="text-align: right"><span>{{$current_stock->ro_level}}</td>
                            <td style="text-align: right"><span>{{$current_stock->rate}}</td>
                            <td style="text-align: right"><span>{{$current_stock->dis_per}}</td>
                            <td style="text-align: right"><span>{{$current_stock->vat}}</span></td>
                            <td style="text-align: right;"><span>{{$current_stock->total_amount}}</span></td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="10" style="text-align: right"><span>Total :</span></td>
                            <td colspan="1" style="text-align: right" id="totalAmount"></td>
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

    let sumTotal,columnCount,purchaseDetailTable;
    sumTotal = 0;
    columnCount = document.getElementById('purchaseDetailTable').rows[0].cells.length;
    purchaseDetailTable = document.getElementById('purchaseDetailTable');
    // console.log(purchaseDetailTable.rows[13].cells[columnCount-1].innerHTML);
    for (let i =1; i < purchaseDetailTable.rows.length-1; i++) {
        sumTotal += parseFloat(purchaseDetailTable.rows[i].cells[columnCount-1].innerText);
        console.log(sumTotal);
    }
    document.getElementById("totalAmount").innerHTML = `<span>${sumTotal.toFixed(2)}<span>` ;
</script>
@endsection
