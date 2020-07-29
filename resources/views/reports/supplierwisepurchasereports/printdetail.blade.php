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
                        <tr><th style="text-align: center;width: 100%">Supplier Wise Purchase Report</th></tr>
                        <tr><th style="text-align: center;width: 100%">Dates : {{ $from_date }}  -  {{$to_date}}</th></tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content pt-2">
        <div class="panel panel-primary">
            <div class="panel-body" style="margin: 0 5%">
                <table border="1" width="100%"  class="table table-bordered" id="supplierwisepurchasedetail"
                       style="font-size: 16px;">
                    <thead>
                    <tr>
{{--                        <th>S.N.</th>--}}
                        <th colspan="11" style="text-align: left;">Supplier Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($supplier_details as $key =>$supplier_detail)
                        <tr class="supplier-wise-detail" id = "spd-{{ $supplier_detail->id }}" style="background-color: white;font-size: 20px;">
{{--                            <td style="text-align: right"><span>{{++$key}}</td>--}}
                            <th colspan="11" style="text-align: left;"><span>{{$supplier_detail->name}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </section>
</div>
@endsection

@section('scripts')
    <script>
        let supplierWiseDetail = document.querySelector("#supplierwisepurchasedetail");
        // console.log(supplierWiseDetail.rows[1].id);
        const endpoint = '/supplier-wise-purchase-report/get_details';

        function formatParams( params ){
            return "?" + Object
                .keys(params)
                .map(function(key){
                    return key+"="+encodeURIComponent(params[key])
                })
                .join("&")
        }

        for (let i =1; i <= supplierWiseDetail.rows.length-1; i++) {
            let output = `<tr>
                          <th>R. Date</th>
                          <th>Inv. No</th>
                          <th>S. BillNo</th>
                          <th>Item Code</th>
                          <th>Item Name</th>
                          <th>Item Type</th>
                          <th>Qty</th>
                          <th>Rate</th>
                          <th>Discount(%)</th>
                          <th>VAT(%)</th>
                          <th>Total</th>
                          </tr>`;
            let supplierRawID = supplierWiseDetail.rows[i].id
            let supplierId = supplierRawID.split("-")[1];
            let params = {
                supplier_id: parseInt(supplierId),
                from_date: '{{ $from_date }}',
                to_date: '{{ $to_date }}'
            }
            let url = endpoint + formatParams(params)
            console.log(i,supplierId);
            getData(url)

            function getData(url) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', url , true);

                xhr.onload = function () {
                    if (this.status == 200) {
                        let totolAmount = 0;
                        let data = JSON.parse(this.responseText);
                        for (let i in data) {
                            output += `<tr>
                                       <td style="text-align: center;">${data[i].received_date}</td>
                                       <td style="text-align: center;">${data[i].purchase_no}</td>
                                       <td style="text-align: left;">${data[i].supplier_bill_no}</td>
                                       <td style="text-align: right;">${data[i].code}</td>
                                       <td style="text-align: left;">${data[i].items_name}</td>
                                       <td style="text-align: left;">${data[i].edition}</td>
                                       <td style="text-align: right;">${data[i].qty}</td>
                                       <td style="text-align: right;">${data[i].rate}</td>
                                       <td style="text-align: right;">${data[i].dis_per}</td>
                                       <td style="text-align: right;">${data[i].vat}</td>
                                       <td style="text-align: right;">${data[i].total_amount}</td>
                                       </tr>`;
                            totolAmount += data[i].total_amount;
                        }

                        output += `<tr>
                                   <td colspan="10" style="text-align: right;">Total</td>
                                   <td colspan="1" style="text-align: right;">${totolAmount.toFixed(2)}</td>
                                   </tr>`;

                        document.getElementById(supplierRawID).insertAdjacentHTML('afterend',output);
                    };
                }
                xhr.send();
            }
        }
    </script>
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
</script>
@endsection
