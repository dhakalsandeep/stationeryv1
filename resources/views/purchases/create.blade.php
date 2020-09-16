@extends('layouts.admin')
@section('styles')
    <style>
        .table tr { padding: 0; }
        .table th,td { padding: 2px; }
        .twitter-typeahead {
            background-color: #fff;
            padding: 0;
            width: 100%;
            border-color: #fff;
        }
        .tt-menu { width: 100%; margin-top: 1em;}
        .tt-cursor { background: #96e3f8; }
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
                            <div class="col-md-12 d-flex ip-invoice-detail mt-2" style="justify-content: space-between;margin: auto 0;">
                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="ip_item_id"
                                           type="text"
                                           class="form-control ip-item-id"
                                           value="{{ old('ip_item_id') }}"
                                           style="display: none"
                                           autocomplete="ip_item_id" autofocus>
                                    @error('ip_item_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                    <input id="ip_item_name"
                                           type="text"
                                           class="form-control ip-item-name typeahead"
                                           placeholder="Enter Item Name"
                                           value="{{ old('ip_item_name') }}"
                                           autocomplete="ip_item_name" autofocus>
                                    @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="ip_edition"
                                           type="text"
                                           placeholder="Edition"
                                           class="form-control ip-edition"
                                           value="{{ old('ip_edition') }}"
                                           autocomplete="ip_edition" autofocus>
                                    @error('ip_edition')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="ip_amount"
                                           type="number"
                                           placeholder="0.00"
                                           class="form-control text-right ip-amount"
                                           value="{{ old('ip_amount') }}"
                                           autocomplete="ip_amount" autofocus>
                                    @error('ip_amount')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <input id="ip_qty"
                                           type="number"
                                           placeholder="000"
                                           class="form-control text-right ip-qty"
                                           value="{{ old('ip_qty') }}"
                                           autocomplete="ip_qty" autofocus>
                                    @error('ip_qty')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <input id="ip_discount"
                                           type="number"
                                           placeholder="0.00"
                                           class="form-control text-right ip-discount"
                                           value="{{ old('ip_discount') }}"
                                           autocomplete="ip_discount" autofocus>
                                    @error('ip_discount')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;display: none;">
                                    <input id="ip_vat"
                                           type="number"
                                           placeholder="0.00"
                                           class="form-control text-right ip-vat"
                                           value="{{ 0 }}"
                                           autocomplete="ip_vat" autofocus>
                                    @error('ip_vat')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="ip_total"
                                           type="number"
                                           step="0.01"
                                           placeholder="0.00"
                                           class="form-control text-right ip-total"
                                           value="{{ old('ip_total') }}"
                                           autocomplete="ip_total" disabled>

                                    @error('total')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror

                                </div>
                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <button class="form-control btn btn-primary btn-xs add-detail" id="addDetail"><i class="fa fa-plus"></i> </button>
                                </div>
                            </div>

                            {{--                        <div class="col-md-12 add-detail-btn-wrapper pt-4" style="width: 100%; text-align: right">--}}
                            {{--                            <button class="form-control btn btn-primary btn-xs add-detail" id="addDetail"><i class="fa fa-plus"></i> </button>--}}
                            {{--                        </div>--}}

                        </div>

                        <div class="row mt-2 border border-light">
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

                            <div class="col-md-12 d-flex invoice-detail mt-2" id="invoiceDetail-1" style="justify-content: space-between;margin: auto 0;">
                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="item_id"
                                           name="item_id[]"
                                           type="text"
                                           class="form-control item-id"
                                           value="{{ old('item_id') }}"
                                           style="display: none"
                                           autocomplete="item_id">
                                    @error('item_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                    <input id="item_name"
                                           name="item_name[]"
                                           type="text"
                                           class="form-control item-name"
                                           value="{{ old('item_name') }}"
                                           autocomplete="item_name" readonly>
                                    @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                    {{--                                <select class="form-control" name="item[]" id="item" autofocus>--}}
                                    {{--                                <option disabled selected value>select an item</option>--}}
                                    {{--                                @foreach($items as $item)--}}
                                    {{--                                        <option value="{{$item->id}}">{{$item->name}}</option>--}}
                                    {{--                                    @endforeach--}}
                                    {{--                                </select>--}}
                                    {{--                                @error('item')--}}
                                    {{--                                <span class="invalid-feedback" role="alert">--}}
                                    {{--                                    <strong>{{ $message }}</strong>--}}
                                    {{--                                </span>--}}
                                    {{--                                @enderror--}}
                                </div>
                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <input id="edition"
                                           name="edition[]"
                                           type="text"
                                           class="form-control edition"
                                           value="{{ old('edition') }}"
                                           autocomplete="edition" readonly>
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
                                           class="form-control text-right amount"
                                           value="{{ old('amount') }}"
                                           autocomplete="amount" readonly>
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
                                           class="form-control text-right qty"
                                           value="{{ old('qty') }}"
                                           autocomplete="qty" readonly>
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
                                           class="form-control text-right discount"
                                           value="{{ old('discount') }}"
                                           autocomplete="discount" readonly>
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
                                    <input id="total"
                                           name="total[]"
                                           type="number"
                                           step="0.01"
                                           class="form-control text-right total-amount"
                                           value="{{ old('total') }}"
                                           autocomplete="total" readonly>

                                    @error('total')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror

                                </div>
                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <button class="form-control btn btn-danger remove-detail" id="removeDetail"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>

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
                        </div>

                        <div class="row">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.1/bloodhound.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.1/typeahead.bundle.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.1/typeahead.jquery.min.js"></script>--}}

    <script type="text/javascript">
        let bloodhound;
        let currentDate,currentNepaliDate,formatedNepaliDate;
        let invoiceDetailId,invoiceDetail, invoiceDetails,ip_item_name,ip_amount,ip_qty,ip_discount,ip_vat;
        let itemList,selectedItem;
        let amount, sub_total,qty,discount,vat,vat_per,total,net_total;
        let item_name,sum_sub,sum_qty,sum_amount,sum_discount,sum_dis_per,sum_total,sum_vat,sum_grand_total;

        $(() => {
            // Get Items List
            {{--( function () {--}}
                {{--    let url = '{{ route('item.fetch.item') }}';--}}
                {{--    itemList = [];--}}
                {{--    // console.log(url);--}}
                {{--    $.ajax({--}}
                {{--        method: 'get',--}}
                {{--        url: url,--}}
                {{--        success: function (res) {--}}
                {{--            if (res != '') {--}}
                {{--                // console.log(res);--}}
                {{--                // itemList = res;--}}
                {{--                itemList = res;--}}
                {{--                console.log(itemList);--}}

                {{--            }--}}
                {{--        }--}}

                {{--    })--}}
                {{--}())--}}

                selectedItem= [];

            bloodhound = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: `/item/fetch-item?query=%QUERY%`,
                    wildcard: '%QUERY%'
                },
                // local: itemList,
                // local: [{color: 'Red'},{color: 'Blood Red'},{color:'White'},{color: 'Blue'},{color: 'Yellow'},{color: 'Green'},{color:'Black'},{color: 'Pink'},{color: 'Orange'}]
            });

            // bloodhound.initialize();
            console.log(bloodhound);

            $('.ip-invoice-detail #ip_item_name').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'item-list',
                // source: bloodhound,
                source: bloodhound,
                display: function(data) {
                    console.log(data);
                    return data.name  //Input value to be set when you select a suggestion.
                    // return data.name  //Input value to be set when you select a suggestion.
                },
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function(data) {
                        return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.name + '</div></div>'
                    }
                }
            });

            $('.ip-invoice-detail #ip_item_name').on('typeahead:selected', function(evt, item) {
                console.log(evt, item);
                $('#ip_item_id').val(item.id);
                selectedItem.push(item.id);
            })

            ip_qty = $("#ip_qty");
            ip_qty.keyup(function () {
                calculate_amount();
                calculate_total();
            });

            ip_discount = $("#ip_discount");
            ip_discount.keyup(function () {
                calculate_amount();
                calculate_total();
            });

            ip_vat = $("#ip_vat");
            ip_vat.keyup(function () {
                calculate_amount();
                calculate_total();
            });

            $(window).keydown(function (e) {
                let isSaveFocus = $('#btn_save_data').is(':focus');
                let activeElement = document.activeElement;
                if (e.keyCode == 13 && isSaveFocus == false) {
                    e.preventDefault();
                    return false;
                }
                if (e.keyCode == 9 && activeElement.id == "ip_discount") {
                    e.preventDefault();
                    if (parseFloat($("#ip_qty").val()) > 0 && parseFloat($("#ip_amount").val()) > 0) {
                        calculate_amount();
                        addInvoiceDetail();
                        calculate_total();
                    }
                    document.getElementById("ip_item_name").focus();
                    e.preventDefault();
                }
            });

            function calculate_amount() {
                qty = isNaN(parseFloat($("#ip_qty").val())) ? 0 : parseFloat($("#ip_qty").val());
                amount = isNaN(parseFloat($("#ip_amount").val())) ? 0 : parseFloat($("#ip_amount").val());
                discount = isNaN(parseFloat($("#ip_discount").val())) ? 0 : parseFloat($("#ip_discount").val());
                sub_total = qty * amount * (1 - discount / 100);
                vat_per = isNaN(parseFloat($("#ip_vat").val())) ? 0 : parseFloat($("#ip_vat").val());
                total = parseFloat(sub_total) * (1 + vat_per / 100);
                $("#ip_total").val(total.toFixed(2));

            }

            const calculate_total = () => {
                let $trs = $('.invoice-detail');
                sum_sub = 0;
                sum_dis_per = 0;
                sum_discount = 0;
                sum_total = 0;
                $trs.each(function () {
                    sum_qty = isNaN(parseFloat($(this).find('#qty').val())) ? 0 : parseFloat($(this).find('#qty').val());
                    sum_amount = isNaN(parseFloat($(this).find('#amount').val())) ? 0 : parseFloat($(this).find('#amount').val());
                    discount = isNaN(parseFloat($(this).find('#discount').val())) ? 0 : parseFloat($(this).find('#discount').val());
                    net_total = isNaN(parseFloat($(this).find('#total').val())) ? 0 : parseFloat($(this).find('#total').val());

                    if (sum_qty && sum_amount) {
                        sum_sub += (sum_qty * sum_amount);
                    }
                    if (discount) {
                        sum_discount += sum_qty * sum_amount * discount / 100;
                    }
                });
                if (sum_discount > 0) {
                    sum_dis_per = sum_discount / sum_sub * 100;
                }
                sum_total = sum_sub - sum_discount;
                sum_vat = 0;
                sum_grand_total = sum_total * (1 + sum_vat / 100);
                $('#sub_total').val(sum_sub);
                $('#total_discount').val(sum_discount);
                $('#dis_per').val(sum_dis_per.toFixed(2));
                $('#sum_total').val(sum_total.toFixed(2));
                $('#total_vat').val(sum_vat.toFixed(2));
                $('#grand_total').val(sum_grand_total.toFixed(2));

            };

            const setInvoiceDetailId = () => {
                let invoiceDetails = document.querySelectorAll(".invoice-detail");
                for (let i = 0; i < invoiceDetails.length; i++) {
                    invoiceDetails[i].id = `invoiceDetail-${i}`;
                }

            }
            const addInvoiceDetail = () => {
                if ($('.invoice-detail .item-name').val()) {
                    let $invoiceDetail = $('.invoice-detail').first().clone(true); // if you want to clone events also, add true in clone(true)
                    $invoiceDetail.find('input').val('');
                    $('.invoice-detail').last().after($invoiceDetail);
                    setInvoiceDetailId();
                }
                let $div = $('.invoice-detail').last();
                $div.find('.item-id').val($('.ip-item-id').val());
                $div.find('.item-name').val($('#ip_item_name').val());
                $div.find('.edition').val($('.ip-edition').val());
                $div.find('.amount').val($('.ip-amount').val());
                $div.find('.qty').val($('.ip-qty').val());
                $div.find('.discount').val($('.ip-discount').val());
                $div.find('.total-amount').val($('.ip-total').val());

                clearInput();
            }
            const clearInput = () => {
                $(".ip-item-id").val("");
                $(".ip-item-name").val("");
                $(".ip-edition").val("");
                $(".ip-amount").val("");
                $(".ip-qty").val("");
                $(".ip-discount").val("");
                $(".ip-total").val("");
            }
            $('.add-detail').click(function (e) {
                e.preventDefault();
                addInvoiceDetail();
                document.getElementById("ip_item_name").focus();
                e.preventDefault();
            });
            $('.remove-detail').click(function (e) {
                e.preventDefault();
                let $details = $('.invoice-detail');
                if ($details.length > 1) {
                    $(this).closest('.invoice-detail').remove();
                    setInvoiceDetailId();
                } else {
                    alert("Can not delete first")
                }
            })

        })
    </script>

    {{-- Nepali Date picker--}}
    <script>
        $("#supplier_bill_date").nepaliDatePicker({
            dateFormat: "%y-%m-%d",
            closeOnDateSelect: true
        });
        $("#received_date").nepaliDatePicker({
            dateFormat: "%y-%m-%d",
            closeOnDateSelect: true
        });
        currentDate = new Date();
        currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
        formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        $("#supplier_bill_date").val(formatedNepaliDate);
        $("#received_date").val(formatedNepaliDate);
    </script>
@stop
@endsection
