{{--<input type="button" onclick="tableToExcel('tablename', 'name', 'myfile.xls')" value="Export to Excel">--}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="panel panel-primary">
            <div class="panel-body">
                <table width="100%" class="table">
                    <thead>
                        <tr><th style="text-align: center;width: 100%;font-weight: bold;font-size: 25px;">{{  $company_info->name }}</th></tr>
                        <tr><th style="text-align: center;width: 100%">{{  $company_info->address }}</th></tr>
                        <tr><th style="text-align: center;width: 100%">Purchase Receipt</th></tr>
                        <tr>
                            <th style=" width: 50%;text-align: left">Supplier Bill No  : {{ strtoupper($purchase_master->supplier_bill_no) }}</th>
                            <th style=" width: 50%;text-align: right">Purchase No : {{ strtoupper($purchase_master->purchase_no) }}</th>
                        </tr>
                        <tr></tr>
                        <tr>
                            <th style="text-align: left;width: 50%">Supplier Bill Date  : {{ ($purchase_master->supplier_bill_date) }}</th>
                            <th style="text-align: right;width: 50%">Received Date  : {{ ($purchase_master->received_date) }}</th>
                        </tr>
                        <tr style="text-align: right;"><th width="100%">Fiscal Year:  <span>{{ $purchase_master->fiscal_year }}</span></th></tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

{{--        <div class="center-header" style="position: relative;text-align: center">--}}
{{--            <h2 class="table__title__header" style="margin: 0px;">{{  $company_info->name }}</h2>--}}
{{--            <div class="right-header" style="position: absolute;right: 0;top: 0">--}}
{{--                <span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="center-header" style="position: relative;text-align: center">--}}
{{--            <h4 class="table__title__header" style="margin: 0px;">{{  $company_info->address }}</h4>--}}
{{--            <div class="right-header" style="position: absolute;right: 0;top: 0">--}}
{{--                <span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="center-header" style="position: relative;text-align: center">--}}
{{--            <strong>Purchase Receipt</strong>--}}
{{--        </div>--}}
{{--        <div class="center-header" style="position: relative;text-align: left;font-size: 13px">--}}
{{--            Supplier Bill No  : {{ strtoupper($purchase_master->supplier_bill_no) }}--}}
{{--            <div class="right-header" style="position: absolute;right: 0;top: 0">--}}
{{--                Purchase No : <span class="e-n-t-n-n">{{ strtoupper($purchase_master->purchase_no) }}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="center-header" style="position: relative;text-align: left;font-size: 13px">--}}
{{--            Supplier Bill Date  : <span id="supplierBillDate">{{ ($purchase_master->supplier_bill_date) }}</span>--}}
{{--            <div class="right-header" style="position: absolute;right: 0;top: 0">--}}
{{--                Received Date : <span id="receivedBillDate">{{ $purchase_master->received_date }}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="center-header" style="position: relative;text-align: right;font-size: 13px">--}}
{{--            Fiscal Year:  <span>{{ $purchase_master->fiscal_year }}</span>--}}
{{--        </div>--}}

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-body">
                <table width="100%" class="table table-bordered" id="billDetailTable"
                       style="background-color:#dbdbdb; font-size: 12px">
                    <thead>
                    <tr>
                        <th style="width: 5%">S. No.</th>
                        <th style="width: 35%">Particulars </th>
                        <th style="width: 20%">Edition</th>
                        <th style="width: 10%">Amount </th>
                        <th style="width: 10%">Qty</th>
                        <th style="width: 10%">Discount</th>
                        <th style="width: 10%">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase_details as $key =>$purchase_detail)
                        <tr style="background-color: white;">
                            <td style="text-align: center"><span class="e-n-t-n-n">{{++$key}}</span></td>
                            <td style="text-align: left">
                                <span class="e-n-t-n-n">{{ $purchase_detail->items->name }}</span>
                            </td>
                            <td style="text-align: left">
                                <span class="e-n-t-n-n">{{ $purchase_detail->edition }}</span>
                            </td>
                            <td style="text-align:right">
                                <span class="e-n-t-n-n">{{ $purchase_detail->amount }}</span>
                            </td>
                            <td style="text-align:right">
                                <span class="e-n-t-n-n">{{ $purchase_detail->qty }}</span>
                            </td>
                            <td style="text-align:right">
                                <span class="e-n-t-n-n">{{ $purchase_detail->discount }}</span>
                            </td>
                            <td style="text-align:right">
                                <span class="e-n-t-n-n">{{ $purchase_detail->total_amount }}</span>
                            </td>
                        </tr>

                    @endforeach

                    <tr style="background-color: white;font-weight: bold;">
                        <td colspan="6" style="text-align: right;">
                            <span class="e-n-t-n-n">Sub Total : </span>
                        </td>
                        <td style="text-align: right;">
                            <span class="e-n-t-n-n">{{$purchase_master->amount}}</span>
                        </td>
                    </tr>
                    <tr style="background-color: white;font-weight: bold;">
                        <td colspan="6" style="text-align: right;">
                            <span class="e-n-t-n-n">Discount : </span>
                        </td>
                        <td style="text-align: right;">
                            <span class="e-n-t-n-n">{{$purchase_master->discount}}</span>
                        </td>
                    </tr>
                    <tr style="background-color: white;font-weight: bold;">
                        <td colspan="6" style="text-align: right;">
                            <span class="e-n-t-n-n">Total : </span>
                        </td>
                        <td style="text-align: right;">
                            <span class="e-n-t-n-n">{{ $purchase_master->amount - $purchase_master->discount }}</span>
                        </td>
                    </tr>
                    <tr style="background-color: white;font-weight: bold;">
                        <td colspan="6" style="text-align: right;">
                            <span class="e-n-t-n-n">VAT(%) :</span>
                        </td>
                        <td style="text-align: right;">
                            <span class="e-n-t-n-n">{{$purchase_master->vat}}%</span>
                        </td>
                    </tr>
                    <tr style="background-color: white;font-weight: bold;">
                        <td colspan="6" style="text-align: right;">
                            <span class="e-n-t-n-n">Grand Total :</span>
                        </td>
                        <td style="text-align: right;">
                            <span class="e-n-t-n-n">{{$purchase_master->total_amount}}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>

    </section>

{{--    <section class="content-header" style="padding-top: 30px">--}}
{{--        <table width="98%" style="font-size:13px">--}}
{{--            <tr>--}}
{{--                <td colspan="8" style="text-align: left">………………………………………………</td>--}}
{{--                <td colspan="4" style="text-align: right">………………………………………………</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td colspan="8" style="text-align: left">बुझाउनेको सही :</td>--}}
{{--                <td colspan="4" style="text-align: right">बुझिलिनेको सही :</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td colspan="8" style="text-align: left">स्थायी लेखा नं :  ………………………………………………</td>--}}
{{--                <td colspan="4" style="text-align: right">नाम : {{$purchase_master->user->name}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td colspan="12" style="text-align: right">दर्जा : ..............</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td colspan="12" style="text-align: right">कर्मचारी संकेत नं : 1</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td colspan="8" style="text-align: left">प्रिन्ट मिति :<span id="printDate"></span> </td>--}}
{{--                <td colspan="4" style="text-align: left">प्रिन्ट गर्नेको नाम : {{$purchase_master->user->name}}</td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--    </section>--}}

    <!-- /.content -->
</div>


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


<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
