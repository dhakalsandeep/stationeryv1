@extends('layouts.admin')
@section('styles')
    <style>
        .table tr { padding: 0; }
        .table th,td { padding: 2px;}
    </style>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header font-weight-bold" style="font-size: 200%;">Purchases</div>

            <div class="card-body">
                <form action="{{route('purchase.store')}}" enctype="multipart/form-data" id="purchase_form" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6 pl-3 row form-check-inline">
                            <label for="fiscal_year" class="col-3" style="margin: auto 0;">Fiscal Year</label>
                            <input id="fiscal_year"
                                   name="fiscal_year"
                                   type="text"
                                   class="form-control pl-2 font-weight-bold text-center"
                                   style="width: 80px;"
                                   value="{{ $fiscal_year->fiscal_year }}"
                                   readonly
                                   autocomplete="fiscal_year">
                            @error('fiscal_year')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 d-flex" style="justify-content: space-between;">
                            <div class="form-group col-4 row">
                                <label for="supplier">Supplier</label>
                                <select class="form-control" name="suppliers_id" id="supplier" autofocus>
                                    <option value=""></option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                                @error('supplier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4 row pl-3">
                                <label for="supplier_bill_no">Supplier Bill No</label>
                                <input id="supplier_bill_no"
                                       name="supplier_bill_no"
                                       type="text"
                                       class="form-control"
                                       style="text-transform:uppercase"
                                       value="{{ old('supplier_bill_no') }}"
                                       autocomplete="supplier_bill_no" autofocus>
                                @error('supplier_bill_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4 row pl-3">
                                <label for="supplier_bill_date">Supplier Bill Date</label>
                                <input id="supplier_bill_date"
                                       name="supplier_bill_date"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('supplier_bill_date') }}"
                                       autocomplete="supplier_bill_date" autofocus>
                                @error('supplier_bill_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 d-flex" style="justify-content: space-between;">
                            <div class="form-group col-4 row">
                                <label for="purchase_no">Purchase No</label>
                                <input id="purchase_no"
                                       name="purchase_no"
                                       type="text"
                                       class="form-control"
                                       value="{{ $purchase_no }}"
                                       readonly
                                       autocomplete="purchase_no" autofocus>
                                @error('purchase_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4 row pl-3">
                                <label for="received_date">Received Date</label>
                                <input id="received_date"
                                       name="received_date"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('received_date') }}"
                                       autocomplete="received_date" autofocus>
                                @error('received_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4 row pl-3">
                                <label for="received_by">Received By</label>
                                <input id="received_by"
                                       name="received_by"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('received_by') }}"
                                       autocomplete="received_by" autofocus>
                                @error('received_by')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <input type="checkbox" id="isPaymentDone" name="is_payment_done">
                            <label for="isPaymentDone">Is Payment Done</label><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex" style="justify-content: space-between;margin: auto 0;">
                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;justify-content: center;">
                                <label for="item" style="margin: auto 0;">Item Name</label>
                            </div>

                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;justify-content: center;">
                                <label for="edition" style="margin: auto 0;">Edition</label>
                            </div>

                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;justify-content: center;">
                                <label for="amount" style="margin: auto 0;">Amount</label>
                            </div>


                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;justify-content: center;">
                                <label for="qty" style="margin: auto 0;">Qty</label>
                            </div>

                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;justify-content: center;">
                                <label for="discount" style="margin: auto 0;">Discount(%)</label>
                            </div>

                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;justify-content: center;display: none;">
                                <label for="vat" style="margin: auto 0;">VAT</label>
                            </div>

                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;justify-content: center;">
                                <label for="total">Total</label>
                            </div>
                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;justify-content: center;">
                                <label for="total">&nbsp</label>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex invoice-detail mt-2" style="justify-content: space-between;margin: auto 0;">
                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                <select class="form-control" name="item[]" id="item" autofocus>
                                <option disabled selected value>select an item</option>
                                @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('item')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                <input id="edition"
                                       name="edition[]"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('edition') }}"
                                       autocomplete="edition" autofocus>
                                @error('edition')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                <input id="amount"
                                       name="amount[]"
                                       type="number"
                                       class="form-control text-right"
                                       value="{{ old('amount') }}"
                                       autocomplete="amount" autofocus>
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                <input id="qty"
                                       name="qty[]"
                                       type="number"
                                       class="form-control text-right"
                                       value="{{ old('qty') }}"
                                       autocomplete="qty" autofocus>
                                @error('qty')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                <input id="discount"
                                       name="discount[]"
                                       type="number"
                                       class="form-control text-right"
                                       value="{{ old('discount') }}"
                                       autocomplete="discount" autofocus>
                                @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;display: none;">
                                <input id="vat"
                                       name="vat[]"
                                       type="number"
                                       class="form-control text-right"
                                       value="{{ 0 }}"
                                       autocomplete="vat" autofocus>
                                @error('vat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                <input id="total"
                                       name="total[]"
                                       type="number"
                                       step="0.01"
                                       class="form-control text-right totalAmount"
                                       value="{{ old('total') }}"
                                       autocomplete="total" disabled>

                                @error('total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
{{--                                <button class="btn btn-danger btn-xs" id="removeDetail" style="position: absolute;right: -14px;bottom: 9px;"><i class="fa fa-times"></i></button>--}}

                            </div>
                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
{{--                                <button class="form-control btn btn-primary btn-xs" id="addDetail"><i class="fa fa-plus"></i> </button>--}}
                                <button class="form-control btn btn-danger" id="removeDetail" disabled="true"><i class="fa fa-trash"></i></button>

                            </div>
                        </div>

                        <div class="col-md-12 add-detail-btn-wrapper pt-4" style="width: 100%; text-align: right">
                            <button class="form-control btn btn-primary btn-xs" id="addDetail"><i class="fa fa-plus"></i> </button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex mt-4" style="justify-content: flex-end;">
                            <div class="col-md-10 row" style="justify-content: flex-end;padding-right: 2rem;">
                                <label for="sub_total" style="margin: auto 0;"><span>Sub Total</span></label>
                            </div>
                            <div class="col-md-2" style="justify-content: flex-end; padding: 0;">
                                <input
                                    id="sub_total"
                                    name="sub_total"
                                    type="number"
                                    class="form-control text-right"
                                    value="{{ old('sub_total') }}"
                                    autocomplete="sub_total"
                                    autofocus
                                />
                            </div>
                        </div>
                        <div class="col-md-12 d-flex mt-4" style="justify-content: flex-end;">
                            <div class="col-md-10 row" style="justify-content: flex-end;padding-right: 2rem;">
                                <label for="total_discount" style="margin: auto 0;"><span>Discount</span></label>
                            </div>
                            <div class="col-md-2 d-flex" style="justify-content: flex-end; padding: 0;margin: auto 0;">
                                <div class="col-md-7" style="justify-content: flex-end; padding: 0 1rem 0 0;">
                                    <input
                                        id="total_discount"
                                        name="total_discount"
                                        type="number"
                                        class="form-control text-right"
                                        value="{{ old('discount') }}"
                                        autocomplete="sub_total"
                                        autofocus
                                    />
                                </div>
                                <div class="col-md-4" style="justify-content: flex-end; padding: 0;">
                                    <input
                                        id="dis_per"
                                        name="total_dis_per"
                                        type="number"
                                        step="0.01"
                                        class="form-control"
                                        value="{{ old('dis_per') }}"
                                        autocomplete="dis_per"
                                        autofocus
                                    />
                                </div>
                                <div class="col-md-1" style="justify-content: flex-end; padding: 0;margin: auto 0;">
                                    <label class="float-right" style="margin: auto 0;"> %</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex mt-4" style="justify-content: flex-end;">
                            <div class="col-md-10 row" style="justify-content: flex-end;padding-right: 2rem;">
                                <label for="sum_total" style="margin: auto 0;"><span>Total</span></label>
                            </div>
                            <div class="col-md-2" style="justify-content: flex-end; padding: 0;">
                                <input
                                    id="sum_total"
                                    name="total_total"
                                    type="number"
                                    class="form-control text-right"
                                    value="{{ old('sub_total') }}"
                                    autocomplete="total"
                                    autofocus
                                />
                            </div>
                        </div>
                        {{--                        <div class="col-md-12 d-flex mt-4" style="justify-content: flex-end;"> --}}
                        {{--                            <div class="col-md-10 row" style="justify-content: flex-end;padding-right: 2rem;">--}}
                        {{--                                <label for="total_vat" style="margin: auto 0;"><span>Vat</span></label>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col-md-2 d-flex" style="justify-content: flex-end; padding: 0;margin: auto 0;">--}}
                        {{--                                <div class="col-md-7" style="justify-content: flex-end; padding: 0 1rem 0 0;">--}}
                        {{--                                    <input--}}
                        {{--                                        id="total_vat"--}}
                        {{--                                        name="total_vat"--}}
                        {{--                                        type="number"--}}
                        {{--                                        class="form-control text-right"--}}
                        {{--                                        value="{{ old('vat') }}"--}}
                        {{--                                        autocomplete="vat"--}}
                        {{--                                        autofocus--}}
                        {{--                                    />--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col-md-1" style="justify-content: flex-end; padding: 0;margin: auto 0;">--}}
                        {{--                                    <label class="float-right" style="margin: auto 0;"> %</label>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="col-md-12 d-flex mt-4" style="justify-content: flex-end;">
                            <div class="col-md-10 row" style="justify-content: flex-end;padding-right: 2rem;">
                                <label for="grand_total" style="margin: auto 0;"><span>Grand Total</span></label>
                            </div>
                            <div class="col-md-2" style="justify-content: flex-end; padding: 0;">
                                <input
                                    id="grand_total"
                                    name="grand_total"
                                    type="number"
                                    class="form-control text-right"
                                    value="{{ old('grand_total') }}"
                                    autocomplete="grand_total"
                                    autofocus
                                />
                            </div>
                        </div>
                        <div class="col-md-12 d-flex pt-4">
                            <button type="submit" id="btn_save_data" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@section('scripts')
<script>
    $(document).on('click', '#btn_save_data', function (e) {
        e.preventDefault();
        console.clear();
        let supplier_bill_date = $('#supplier_bill_date').val();
        //console.log(date_nep);
        let supplier_date_roman = convertNepaliToEnglish(supplier_bill_date);
        $('#supplier_bill_date').val(supplier_date_roman);
        let received_date = $('#received_date').val();
        //console.log(date_nep);
        let received_date_roman = convertNepaliToEnglish(received_date);
        $('#received_date').val(received_date_roman);
        // console.log($('#issue_date').val());
        $('#purchase_form').submit();


    })
</script>
{{--Convert Nepali date to roman date --}}
<script>
    function convertNepaliToEnglish(input) {
        // console.log(input);
        let charArray = input.split('');
        let engDate = '';
        $.each(charArray, function (key, value) {
            switch (value) {
                case '१':
                    engDate += '1';
                    break;
                case '२':
                    engDate += '2';
                    break;
                case '३':
                    engDate += '3';
                    break;
                case '४':
                    engDate += '4';
                    break;
                case '५':
                    engDate += '5';
                    break;
                case '६':
                    engDate += '6';
                    break;
                case '०':
                    engDate += '0';
                    break;
                case '७':
                    engDate += '7';
                    break;
                case '८':
                    engDate += '8';
                    break;
                case '९':
                    engDate += '9';
                    break;

                case '-':
                    engDate += '-';
                    break;
            }

        });
        return engDate;
    }
</script>
<script>
    let amount, sub_total,qty,discount,vat,vat_per,total,net_total;
    let sum_sub,sum_qty,sum_amount,sum_discount,sum_dis_per,sum_total,sum_vat,sum_grand_total;
    $(document).ready(function(){
        qty=$("#qty");
        qty.keyup(function(){
            let $div = $(this).closest('.invoice-detail');
            calculate_amount($div);
            calculate_total();
        });

        discount=$("#discount");
        discount.keyup(function(){
            let $div = $(this).closest('.invoice-detail');
            calculate_amount($div);
            calculate_total();
        });

        vat=$("#vat");
        vat.keyup(function(){
            let $div = $(this).closest('.invoice-detail');
            calculate_amount($div);
            calculate_total();
        });

        $(window).keydown(function(event){
            let isSaveFocus = $('#btn_save_data').is(':focus');
            let activeElement = document.activeElement;
            console.log(activeElement.id);
            if(event.keyCode == 13 && isSaveFocus==false) {
                event.preventDefault();
                return false;
            }
            if (event.keyCode == 9 && activeElement.id=="discount") {
                return addInvoiceDetail();
            }
        });


        function calculate_amount($div) {
            qty=isNaN(parseFloat($div.find("#qty").val())) ? 0 : parseFloat($div.find("#qty").val());
            amount=isNaN(parseFloat($div.find("#amount").val())) ? 0 : parseFloat($div.find("#amount").val());
            discount=isNaN(parseFloat($div.find("#discount").val())) ? 0 : parseFloat($div.find("#discount").val());
            sub_total=qty*amount*(1-discount/100);
            vat_per=isNaN(parseFloat($div.find("#vat").val())) ? 0 : parseFloat($div.find("#vat").val());
            total = parseFloat(sub_total)*(1+vat_per/100);
            $div.find("#total").val(total.toFixed(2));

        }

        function calculate_total () {
            let $trs = $('.invoice-detail');
            sum_sub = 0;
            sum_dis_per = 0;
            sum_discount = 0;
            sum_total = 0;
            $trs.each(function(){
                sum_qty = isNaN(parseFloat($(this).find('#qty').val())) ? 0 : parseFloat($(this).find('#qty').val());
                sum_amount = isNaN(parseFloat($(this).find('#amount').val())) ? 0 : parseFloat($(this).find('#amount').val());
                discount = isNaN(parseFloat($(this).find('#discount').val())) ? 0 : parseFloat($(this).find('#discount').val());
                net_total = isNaN(parseFloat($(this).find('#total').val())) ? 0 : parseFloat($(this).find('#total').val());

                if(sum_qty && sum_amount){
                    sum_sub += (sum_qty*sum_amount);
                }
                if (discount){
                    sum_discount += sum_qty*sum_amount*discount/100;
                }
            });
            if (sum_discount > 0){
                sum_dis_per = sum_discount/sum_sub*100;
            }
            sum_total = sum_sub - sum_discount;
            sum_vat = 0;
            sum_grand_total = sum_total*(1+sum_vat/100);
            $('#sub_total').val(sum_sub);
            $('#total_discount').val(sum_discount);
            $('#dis_per').val(sum_dis_per.toFixed(2));
            $('#sum_total').val(sum_total.toFixed(2));
            $('#total_vat').val(sum_vat.toFixed(2));
            $('#grand_total').val(sum_grand_total.toFixed(2));
        }
    });

    console.clear();
    const addInvoiceDetail = () => {
        let $invoiceDetail = $('.invoice-detail').first().clone(true); // if you want to clone events also, add true in clone(true)
        $invoiceDetail.find('input').val('');
        $('.invoice-detail').last().after($invoiceDetail);
        $('.invoice-detail #item').last().focus();
        // console.log($('.invoice-detail #item').last());
    }
    $('#addDetail').click(function (e) {
        e.preventDefault();
        // let $invoiceDetail = $('.invoice-detail').first().clone(true); // if you want to clone events also, add true in clone(true)
        // $invoiceDetail.find('input').val('');
        // $('.invoice-detail').last().after($invoiceDetail);
        addInvoiceDetail();
    });
    $('#removeDetail').click(function (e) {
        e.preventDefault();
        let $details = $('.invoice-detail');
        if($details.length > 1){
            $(this).closest('.invoice-detail').remove();
        }else{
            alert("Can not delete first")
        }
    });
</script>

{{-- Nepali Date picker--}}
<script>
    $("#supplier_bill_date").nepaliDatePicker({
        dateFormat: "%y-%m-%d",
        closeOnDateSelect: true
    });

    var currentDate = new Date();
    var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
    var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
    // console.log(formatedNepaliDate);
    $("#supplier_bill_date").val(formatedNepaliDate);
</script>

<script>
    $("#received_date").nepaliDatePicker({
        dateFormat: "%y-%m-%d",
        closeOnDateSelect: true
    });

    var currentDate = new Date();
    var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
    var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
    // console.log(`received date ${formatedNepaliDate}`);
    $("#received_date").val(formatedNepaliDate);
</script>
@stop
@endsection
