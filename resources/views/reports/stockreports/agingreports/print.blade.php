{{--<input type="button" onclick="tableToExcel('tablename', 'name', 'myfile.xls')" value="Export to Excel">--}}
@extends('layouts.adminReport')
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
                        <tr><th style="text-align: center;width: 100%">Purchase Detail Report</th></tr>
                        <tr><th style="text-align: center;width: 100%">Dates : {{ $from_date }}  -  {{$to_date}}</th></tr>
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
                       style="background-color:#dbdbdb; font-size: 16px">
                    <thead>
                    <tr>
                        <th style="width: 5%">S. No.</th>
                        <th>R. Date</th>
                        <th>Inv. No</th>
                        <th>S. BillNo</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Item Type</th>
                        <th>Supplier</th>
                        <th>Rate</th>
                        <th>Qty</th>
                        <th>Discount(%)</th>
                        <th>VAT(%)</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase_details as $key =>$purchase_detail)
                        <tr style="background-color: white;">
                            <td style="text-align: right"><span style="padding-right: 5%">{{++$key}}</td>
                            <td style="text-align: center"><span>{{$purchase_detail->received_date}}</td>
                            <td style="text-align: center"><span>{{$purchase_detail->purchase_no}}</td>
                            <td style="text-align: right;"><span style="padding-right: 5%">{{$purchase_detail->supplier_bill_no}}</td>
                            <td style="text-align: left"><span style="padding-left: 5%">{{$purchase_detail->code}}</td>
                            <td style="text-align: left"><span style="padding-left: 5%">{{$purchase_detail->items_name}}</td>
                            <td style="text-align: left"><span style="padding-left: 5%">{{$purchase_detail->type}}</td>
                            <td style="text-align: left"><span style="padding-left: 5%">{{$purchase_detail->supplier_name}}</td>
                            <td style="text-align: right"><span style="padding-right: 5%">{{$purchase_detail->rate}}</td>
                            <td style="text-align: right"><span style="padding-right: 5%">{{$purchase_detail->qty}}</td>
                            <td style="text-align: right"><span style="padding-right: 5%">{{$purchase_detail->dis_per}}</td>
                            <td style="text-align: right"><span style="padding-right: 5%">{{$purchase_detail->vat}}</span></td>
                            <td style="text-align: right;"><span style="padding-right: 5%;">{{$purchase_detail->total_amount}}</span></td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="12" style="text-align: right"><span style="padding-right: 5%">Total :</span></td>
                            <td colspan="1" style="text-align: right" id="totalAmount"><span style="padding-right: 5%;">Total</span></td>
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
    document.getElementById("totalAmount").innerHTML = `<span style="padding-right: 5%">${sumTotal.toFixed(2)}<span>` ;
</script>
@endsection
