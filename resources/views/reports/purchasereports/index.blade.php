@extends('layouts.admin')
@section('page_header')
    Purchase Details Report
@stop
@section('content')

    <div class="card">
        <div class="card-header">
            <form action="/purchase-detail-report/print" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-3 row">
                        <label for="from_date">From Date</label>
                        <input id="from_date"
                               name="from_date"
                               type="date"
                               class="form-control"
                               value="{{ old('from_date') }}"
                               style="border-right-style: hidden;"
                               autocomplete="from_date" autofocus>
                        @error('from_date')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror

                    </div>
                    <div class="form-group col-1 row ml-1">
                        <label for="from_date_format">&nbsp;</label>
                        <input id="from_date_format"
                               name="from_date_format"
                               class="form-control btn btn-info"
                               value="AD">
                    </div>
                    <div class="form-group col-3 row ml-1">
                        <label for="to_date">To Date</label>
                        <input id="to_date"
                               name="to_date"
                               type="date"
                               class="form-control"
                               value="{{ old('to_date') }}"
                               autocomplete="to_date" autofocus>
                        @error('to_date')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group col-1 row ml-1">
                        <label for="to_date_format">&nbsp;</label>
                        <input id="to_date_format"
                               name="to_date_format"
                               class="form-control btn btn-info"
                               value="AD">
                    </div>
                    <div class="form-group col-2 row ml-1">
                        <label for="btn_get_data">&nbsp</label>
                        <input type="button" id="btn_get_data" value="Get"
                               class="form-control btn btn-primary" autofocus>
                    </div>
                    <div class="form-group col-2 row ml-1">
                        <label for="btn_print_data">&nbsp</label>
                        <input type="submit" id="btn_print_data" value="Print"
                               class="form-control btn btn-primary" autofocus>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable" id="datatable">
                    <thead>
                    <tr>
{{--                        <th></th>--}}
{{--                        <th style="display: none"></th>--}}
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
                </table>
            </div>
        </div>
    </div>
@section('scripts')

    {{--Convert Nepali date to roman date --}}
{{--    <script>--}}
{{--        function convertNepaliToEnglish(input) {--}}
{{--            // console.log(input);--}}
{{--            let charArray = input.split('');--}}
{{--            let engDate = '';--}}
{{--            $.each(charArray, function (key, value) {--}}
{{--                switch (value) {--}}
{{--                    case '१':--}}
{{--                        engDate += '1';--}}
{{--                        break;--}}
{{--                    case '२':--}}
{{--                        engDate += '2';--}}
{{--                        break;--}}
{{--                    case '३':--}}
{{--                        engDate += '3';--}}
{{--                        break;--}}
{{--                    case '४':--}}
{{--                        engDate += '4';--}}
{{--                        break;--}}
{{--                    case '५':--}}
{{--                        engDate += '5';--}}
{{--                        break;--}}
{{--                    case '६':--}}
{{--                        engDate += '6';--}}
{{--                        break;--}}
{{--                    case '०':--}}
{{--                        engDate += '0';--}}
{{--                        break;--}}
{{--                    case '७':--}}
{{--                        engDate += '7';--}}
{{--                        break;--}}
{{--                    case '८':--}}
{{--                        engDate += '8';--}}
{{--                        break;--}}
{{--                    case '९':--}}
{{--                        engDate += '9';--}}
{{--                        break;--}}

{{--                    case '-':--}}
{{--                        engDate += '-';--}}
{{--                        break;--}}
{{--                }--}}

{{--            });--}}
{{--            return engDate;--}}
{{--        }--}}
{{--    </script>--}}

    <script>
        $(function () {
            let dtButtons = [];
            var date = new Date();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            fetch_data();


            function fetch_data(from_date = '', to_date = '')
            {
                console.log("fetch data");

                $('#datatable').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    // pageLength: 100,

                    ajax: {
                        url: "{{ route('get.purchase.reports.fetchdata') }}",
                        type: 'GET',
                        data: function (d) {
                            d.from_date = from_date;
                            d.to_date = to_date;
                        },

                    },
                    columns:[
                        // {data: "check_box",name:"check_box"},
                        { data: "received_date",name: "received_date" },
                        { data: "purchase_no",name: "purchase_no" },
                        { data: "supplier_bill_no",name: "supplier_bill_no" },
                        { data: "code",name: "code" },
                        { data: "items_name",name: "items_name" },
                        { data: "type",name: "type" },
                        { data: "supplier_name",name: "supplier_name" },
                        { data: "rate",name: "rate" },
                        { data: "qty",name: "qty" },
                        { data: "dis_per",name: "dis_per" },
                        { data: "vat",name: "vat" },
                        { data: "total_amount",name: "total_amount" },
                        // { data: "last_name",name: "last_name" },
                    ],
                });
                // $('#datatable').DataTable().$('.select-checkbox').prop('disabled', false);
                // $('.select-checkbox').css('display','none');
                // $('tbody','tr','td').removeClass("select-checkbox");
            }

            $('#btn_get_data').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                console.log(from_date,to_date);
                if(from_date != '' &&  to_date != '')
                {
                    console.log("here")
                    fetch_data(from_date, to_date);
                }
                else
                {
                    alert('Both Date is required');
                }
                $('#datatable').DataTable().draw(true);

            });
        })
    </script>

    {{--    @parent--}}


{{--    --}}{{-- Nepali Date picker--}}
{{--    <script>--}}
{{--        $("#from_date").nepaliDatePicker({--}}
{{--            dateFormat: "%y-%m-%d",--}}
{{--            closeOnDateSelect: true--}}
{{--        });--}}

{{--        var currentDate = new Date();--}}
{{--        var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());--}}
{{--        console.log(currentNepaliDate);--}}
{{--        var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);--}}
{{--        // var formatedNepaliDate = calendarFunctions.bsDateFormat("mm/dd/yyyy", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);--}}
{{--        console.log(formatedNepaliDate);--}}
{{--        $("#from_date").val(formatedNepaliDate);--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $("#to_date").nepaliDatePicker({--}}
{{--            dateFormat: "%y-%m-%d",--}}
{{--            closeOnDateSelect: true--}}
{{--        });--}}

{{--        var currentDate = new Date();--}}
{{--        var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());--}}
{{--        var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);--}}
{{--        console.log(formatedNepaliDate);--}}
{{--        $("#to_date").val(formatedNepaliDate);--}}
{{--    </script>--}}
@endsection
@endsection
