<!DOCTYPE html>
<html>

<head>
    <!-- Styles -->
    <link href="{{ asset('css/purchasereceiptstyle.css') }}" rel="stylesheet">
</head>

<body>

  <div class="page-header" style="text-align: center">
      <div class="center-header" style="position: relative;text-align: center">
          <h2 class="table__title__header" style="margin: 0px;">{{  $company_info->name }}</h2>
          <div class="right-header" style="position: absolute;right: 0;top: 0">
              <span></span>
          </div>
      </div>
      <div class="center-header" style="position: relative;text-align: center">
          <h4 class="table__title__header" style="margin: 0px;">{{  $company_info->address }}</h4>
          <div class="right-header" style="position: absolute;right: 0;top: 0">
              <span></span>
          </div>
      </div>
      <div class="center-header" style="position: relative;text-align: center">
          <strong>Purchase Receipt</strong>
      </div>
      <div class="center-header" style="position: relative;text-align: left;font-size: 13px">
          Supplier Bill No  : {{ strtoupper($purchase_master->supplier_bill_no) }}
          <div class="right-header" style="position: absolute;right: 0;top: 0">
              Purchase No : <span class="e-n-t-n-n">{{ strtoupper($purchase_master->purchase_no) }}</span>
          </div>
      </div>
      <div class="center-header" style="position: relative;text-align: left;font-size: 13px">
          Supplier Bill Date  : <span id="supplierBillDate">{{ ($purchase_master->supplier_bill_date) }}</span>
          <div class="right-header" style="position: absolute;right: 0;top: 0">
              Received Date : <span id="receivedBillDate">{{ $purchase_master->received_date }}</span>
          </div>
      </div>
      <div class="center-header" style="position: relative;text-align: right;font-size: 13px">
          Fiscal Year:  <span>{{ $purchase_master->fiscal_year }}</span>
      </div>
    <br/>
{{--    <button type="button" onClick="window.print()" style="background: pink">--}}
{{--      PRINT ME!--}}
{{--    </button>--}}
  </div>

  <div class="page-footer">
    <span style="display: none">I'm The Footer</span>
  </div>

  <table width="100%">

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <!--*** CONTENT GOES HERE ***-->
{{--          <div class="page">PAGE 1</div>--}}
{{--          <div class="page">PAGE 2</div>--}}
          <div class="page">
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
{{--                  <tr style="background-color: white;font-weight: bold;">--}}
{{--                      <td colspan="6" style="text-align: right;">--}}
{{--                          <span class="e-n-t-n-n">VAT(%) :</span>--}}
{{--                      </td>--}}
{{--                      <td style="text-align: right;">--}}
{{--                          <span class="e-n-t-n-n">{{$purchase_master->vat}}%</span>--}}
{{--                      </td>--}}
{{--                  </tr>--}}
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
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>

</body>

</html>


