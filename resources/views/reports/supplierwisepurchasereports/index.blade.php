@extends('layouts.admin')
@section('page_header')
    Supplier Wise Purchase Report
@stop
@section('content')

    <div class="card">
        <div class="card-header">
            <form action="{{ route('supplier.wise.purchase.report.print') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-2 row">
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
                    <div class="form-group col-2 row ml-1">
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
                        <label for="btn_print_data">&nbsp</label>
                        <div class="form-control d-flex">

                            <div class="col-6">
                                <input type="radio" id="summary" name="report_type" value="summary" style="vertical-align: middle;" checked>
                                <label for="summary"><span style="vertical-align: middle;">Summary</span></label>
                            </div>
                            <div class="col-6">
                                <input type="radio" id="detail" name="report_type" style="vertical-align: middle;" value="detail">
                                <label for="detail"><span style="vertical-align: middle;">Detail</span></label>
                            </div>
                        </div>
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
                        <th>Supplier Name</th>
                        <th>Amount</th>
                        <th>Return Amount</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@section('scripts')
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
                        url: "{{ route('get.supplier.wise.purchase.report.fetchdata') }}",
                        type: 'GET',
                        data: function (d) {
                            d.from_date = from_date;
                            d.to_date = to_date;
                        },

                    },
                    columns:[
                        // {data: "check_box",name:"check_box"},
                        { data: "name",name: "name", className: "text-left" },
                        { data: "amount",name: "amount", className: "text-right" },
                        { data: "return_amount",name: "return_amount", className: "text-right" },
                        { data: "total",name: "total", className: "text-right" },
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
