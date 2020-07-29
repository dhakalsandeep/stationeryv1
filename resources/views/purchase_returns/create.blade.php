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
            <div class="card-header font-weight-bold" style="font-size: 200%;">Purchase Return</div>

            <div class="card-body">
                <form action="{{ route('purchase.return.store') }}" enctype="multipart/form-data" id="purchase_return_form" method="post">
                    @csrf
                    <div class="row">
                        <input id="purchase_master_id"
                               name="purchase_master_id"
                               type="text"
                               class="form-control pl-2 font-weight-bold text-center"
                               style="width: 80px;"
                               value="{{ $purchase_master->id }}"
                               readonly
                               autocomplete="purchase_master_id" hidden autofocus>
                        @error('purchase_master_id')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
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
                                   autocomplete="fiscal_year" autofocus>
                            @error('fiscal_year')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 d-flex" style="justify-content: space-between;">
                            <div class="form-group col-4 row">
                                <label for="supplier">Supplier</label>
                                <input id="supplier"
                                       name="supplier"
                                       type="text"
                                       class="form-control"
                                       style="text-transform:uppercase"
                                       value="{{ $purchase_master->supplier->name }}"
                                       autocomplete="supplier" readonly autofocus>
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
                                       value="{{ $purchase_master->supplier_bill_no }}"
                                       autocomplete="supplier_bill_no" readonly autofocus>
                                @error('supplier_bill_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-2 row pl-3">
                                <label for="supplier_bill_date">Supplier Bill Date</label>
                                <input id="supplier_bill_date"
                                       name="supplier_bill_date"
                                       type="text"
                                       class="form-control"
                                       value="{{ $purchase_master->supplier_bill_date }}"
                                       autocomplete="supplier_bill_date" readonly autofocus>
                                @error('supplier_bill_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-2 row pl-3">
                                <label for="received_date">Received Date</label>
                                <input id="received_date"
                                       name="received_date"
                                       type="text"
                                       class="form-control"
                                       value="{{ $purchase_master->received_date }}"
                                       autocomplete="received_date" readonly autofocus>
                                @error('received_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 d-flex" style="justify-content: space-between;">
                            <div class="form-group col-2 row">
                                <label for="purchase_no">Purchase No</label>
                                <input id="purchase_no"
                                       name="purchase_no"
                                       type="text"
                                       class="form-control"
                                       value="{{ $purchase_master->purchase_no }}"
                                       readonly
                                       autocomplete="purchase_no" autofocus>
                                @error('purchase_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-2 row">
                                <label for="return_no">Return No</label>
                                <input id="return_no"
                                       name="return_no"
                                       type="text"
                                       value="{{ $purchase_return_no }}"
                                       class="form-control"
                                       readonly
                                       autocomplete="return_no" autofocus>
                                @error('return_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4 row pl-3">
                                <label for="return_date">Return Date</label>
                                <input id="return_date"
                                       name="return_date"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('return_date') }}"
                                       autocomplete="return_date" autofocus>
                                @error('return_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4 row pl-3">
                                <label for="return_by">Return By</label>
                                <input id="return_by"
                                       name="return_by"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('return_by') }}"
                                       autocomplete="return_by" autofocus>
                                @error('return_by')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex" style="justify-content: space-between;margin: auto 0;">
                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;justify-content: center;">
                                <label for="item" style="margin: auto 0;">Item Name</label>
                            </div>

                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;;justify-content: center;">
                                <label for="edition" style="margin: auto 0;">Edition</label>
                            </div>

                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;;justify-content: center;">
                                <label for="amount" style="margin: auto 0;">Amount</label>
                            </div>

                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;;justify-content: center;">
                                <label for="qty" style="margin: auto 0;">Qty</label>
                            </div>

                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;;justify-content: center;">
                                <label for="discount" style="margin: auto 0;">Discount(%)</label>
                            </div>

                            <div class="form-group col-md-1 row" style="display: none;margin: auto 0;padding: 0;;justify-content: center;">
                                <label for="vat" style="margin: auto 0;">VAT</label>
                            </div>

                            <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;;justify-content: center;">
                                <label for="total" style="margin: auto 0;">Total</label>
                            </div>
                            <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;;justify-content: center;">
                                <label for="total" style="margin: auto 0;">&nbsp</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($purchase_details as $purchase_detail)
                            <div class="col-md-12 d-flex invoice-detail pt-2" style="justify-content: space-between;margin: auto 0;" id="invoice-detail-{{ $purchase_detail->id }}" >
                                <div hidden style="margin: auto 0;padding: 0;">
                                    <input id="purchase-detail-{{ $purchase_detail->id }}"
                                           name="purchase_detail_id[]"
                                           type="text"
                                           class="form-control"
                                           value="{{ $purchase_detail->id }}"
                                           autocomplete="edition" >
                                    @error('edition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <select class="form-control" name="item[]" id="item" disabled="true">
                                        @foreach($items as $item)
                                            <option  name="items" value="{{$item->id}}" @if($purchase_detail->items_id == $item->id) selected  @endif}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="edition-{{ $purchase_detail->id }}"
                                           name="edition[]"
                                           type="text"
                                           class="form-control"
                                           value="{{ $purchase_detail->edition }}"
                                           autocomplete="edition" readonly autofocus>
                                    @error('edition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="amount-{{ $purchase_detail->id }}"
                                           name="amount[]"
                                           type="number"
                                           class="form-control text-right amount"
                                           value="{{ $purchase_detail->amount }}"
                                           autocomplete="amount" readonly autofocus>
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <input id="qty-{{ $purchase_detail->id }}"
                                           name="qty[]"
                                           type="number"
                                           min="{{ 1 }}"
                                           max="{{ $purchase_detail->cur_qty }}"
                                           class="form-control text-right qty"
                                           value="{{ $purchase_detail->cur_qty }}"
                                           autocomplete="qty" autofocus>
                                    @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <input id="discount-{{ $purchase_detail->id }}"
                                           name="discount[]"
                                           type="number"
                                           class="form-control text-right discount"
                                           value="{{ $purchase_detail->dis_per }}"
                                           autocomplete="discount" readonly autofocus>
                                    @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-1 row" style="display: none;margin: auto 0;padding: 0;" >
                                    <input id="vat-{{ $purchase_detail->id }}"
                                           name="vat[]"
                                           type="number"
                                           class="form-control text-right vat"
                                           value="{{ 0 }}"
                                           autocomplete="vat" autofocus>
                                    @error('vat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="total-{{ $purchase_detail->id }}"
                                           name="total[]"
                                           type="number"
                                           step="0.01"
                                           class="form-control text-right total"
                                           value="{{ $purchase_detail->total }}"
                                           autocomplete="total" readonly autofocus>
                                    @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <button class="form-control btn btn-danger remove-detail" id="remove-detail-{{ $purchase_detail->id }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        @endforeach
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
        let return_date = $('#return_date').val();
        //console.log(date_nep);
        let return_date_roman = convertNepaliToEnglish(return_date);
        $('#return_date').val(return_date_roman);
        // console.log($('#issue_date').val());
        $('#purchase_return_form').submit();
    });
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
    let id, purchase_detail_id,max_qty,min_qty,temp_qty;
    let amount, sub_total,qty,discount,vat,vat_per,total,net_total;
    let sum_sub,sum_qty,sum_amount,sum_discount,sum_dis_per,sum_total,sum_vat,sum_grand_total;
    $(document).ready(function(){
        init();
        function init() {
            calculate_total ();
        }
        amount=$("#amount");
        qty=$(".qty");
        discount=$("#discount");
        vat=$("#vat");
        $( ".qty" ).change(function(){
            id = $(this).attr("id");
            if (validateQty(id)) {
                purchase_detail_id = id.split("-")[1];
                calculateAll();
            };
        });
        qty.keyup(function(){
            id = $(this).attr("id");
            if (validateQty(id)) {
                purchase_detail_id = id.split("-")[1];
                calculateAll();
            };
        });
        function validateQty() {
            max_qty = parseFloat($(`#${id}`).attr('max'));
            min_qty = parseFloat($(`#${id}`).attr('min'));
            temp_qty = parseFloat($(`#${id}`).val());
            // console.log(temp_qty);
            if (temp_qty > max_qty) {
                alert(`Qty cannot exceed the max limit`);
                $(`#${id}`).val(max_qty);
                calculateAll();
                return false;
            }
            return true;
        }
        function calculateAll() {
            calculate_amount();

            calculate_total();
        }
        function calculate_amount() {
            qty=isNaN(parseFloat($(`#qty-${purchase_detail_id}`).val())) ? 0 : parseFloat($(`#qty-${purchase_detail_id}`).val());
            amount=isNaN(parseFloat($(`#amount-${purchase_detail_id}`).val())) ? 0 : parseFloat($(`#amount-${purchase_detail_id}`).val());
            discount=isNaN(parseFloat($(`#discount-${purchase_detail_id}`).val())) ? 0 : parseFloat($(`#discount-${purchase_detail_id}`).val());
            sub_total=qty*amount*(1-discount/100);
            vat_per=isNaN(parseFloat($(`#vat-${purchase_detail_id}`).val())) ? 0 : parseFloat($(`#vat-${purchase_detail_id}`).val());
            total = parseFloat(sub_total)*(1+vat_per/100);
            $(`#total-${purchase_detail_id}`).val(total.toFixed(2));

        }

        function calculate_total () {
            let $trs = $('.invoice-detail');
            sum_sub = 0;
            sum_dis_per = 0;
            sum_discount = 0;
            sum_total = 0;
            $trs.each(function(){
                id = $(this).attr("id");
                purchase_detail_id = id.split("-")[2];
                sum_qty = isNaN(parseFloat($(this).find(`#qty-${purchase_detail_id}`).val())) ? 0 : parseFloat($(this).find(`#qty-${purchase_detail_id}`).val());
                sum_amount = isNaN(parseFloat($(this).find(`#amount-${purchase_detail_id}`).val())) ? 0 : parseFloat($(this).find(`#amount-${purchase_detail_id}`).val());
                discount = isNaN(parseFloat($(this).find(`#discount-${purchase_detail_id}`).val())) ? 0 : parseFloat($(this).find(`#discount-${purchase_detail_id}`).val());
                net_total = isNaN(parseFloat($(this).find(`#total-${purchase_detail_id}`).val())) ? 0 : parseFloat($(this).find(`#total-${purchase_detail_id}`).val());

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
        $('.remove-detail').click(function (e) {
            e.preventDefault();
            let $details = $('.invoice-detail');
            let id = $(this).attr("id");
            let purchase_detail_id = id.split("-")[2];
            if($details.length > 1){
                $(`#invoice-detail-${purchase_detail_id}`).remove();
                calculate_total();
            }else{
                alert("Can not delete first")
            }
        });
    });

    console.clear();

</script>

<script>
    $("#return_date").nepaliDatePicker({
        dateFormat: "%y-%m-%d",
        closeOnDateSelect: true
    });
    var currentDate = new Date();
    var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
    var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
    // console.log(`received date ${formatedNepaliDate}`);
    $("#return_date").val(formatedNepaliDate);
</script>
@stop
@endsection
