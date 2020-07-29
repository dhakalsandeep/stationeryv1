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
                        <tr><th style="text-align: center;width: 100%">Supplier Wise Purchase Report</th></tr>
                        <tr><th style="text-align: center;width: 100%">Dates : {{ $from_date }}  -  {{$to_date}}</th></tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content pt-2">
        <div class="panel panel-primary">
            <div class="panel-body" style="margin: 0 5%">
                <table border="1" width="100%"  class="table table-bordered" id="supplierwisepurchasedetail"
                       style="background-color:#dbdbdb; font-size: 16px">
                    <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Supplier Name</th>
                        <th>Amount</th>
                        <th>Return Amount</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($supplier_details as $key =>$supplier_detail)
                        <tr style="background-color: white;">
                            <td style="text-align: right"><span>{{++$key}}</td>
                            <td style="text-align: left"><span>{{$supplier_detail->name}}</td>
                            <td style="text-align: right"><span>{{$supplier_detail->amount}}</span></td>
                            <td style="text-align: right;"><span>{{$supplier_detail->return_amount}}</span></td>
                            <td style="text-align: right;"><span>{{$supplier_detail->total}}</span></td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="2" style="text-align: right"><span>Total :</span></td>
                            <td colspan="1" style="text-align: right" id="amount"><span></span></td>
                            <td colspan="1" style="text-align: right" id="returnAmount"><span></span></td>
                            <td colspan="1" style="text-align: right" id="totalAmount"><span></span></td>
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

    let amount, returnAmount, sumTotal,columnCount,supplierwisepurchasedetail;
    amount = 0;
    returnAmount = 0;
    sumTotal = 0;
    columnCount = document.getElementById('supplierwisepurchasedetail').rows[0].cells.length;
    supplierwisepurchasedetail = document.getElementById('supplierwisepurchasedetail');
    // console.log(purchaseDetailTable.rows[13].cells[columnCount-1].innerHTML);
    for (let i =1; i < supplierwisepurchasedetail.rows.length-1; i++) {

        amount += parseFloat(supplierwisepurchasedetail.rows[i].cells[2].innerText);
        returnAmount += parseFloat(supplierwisepurchasedetail.rows[i].cells[3].innerText);
        sumTotal += parseFloat(supplierwisepurchasedetail.rows[i].cells[columnCount-1].innerText);
        console.log(sumTotal);
    }
    document.getElementById("amount").innerHTML = `<span>${amount.toFixed(2)}<span>` ;
    document.getElementById("returnAmount").innerHTML = `<span>${returnAmount.toFixed(2)}<span>` ;
    document.getElementById("totalAmount").innerHTML = `<span>${sumTotal.toFixed(2)}<span>` ;
</script>
@endsection
