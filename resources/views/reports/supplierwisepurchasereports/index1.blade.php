@extends('layouts.admin')
@section('page_header')
    Purchase Details Report
@stop
@section('content')

    <div class="card">
        <div class="card-header">
                <div class="row input-daterange">
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
                    <div class="form-group col-4 row ml-1">
                        <label for="submit">&nbsp</label>
                        <input type="submit" id="btn_get_data" value="Get"
                               class="form-control btn btn-primary" autofocus>
                    </div>
                </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                        <th></th>
                        <th>R. Date</th>
                        <th>Inv. No</th>
                        <th>S. BillNo</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Item Type</th>
                        <th>Supplier</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Discount(%)</th>
                        <th>VAT(%)</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    @foreach($purchase_details as $purchase_detail)--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <td>{{$purchase_detail->received_date}}</td>--}}
{{--                            <td>{{$purchase_detail->purchase_no}}</td>--}}
{{--                            <td>{{$purchase_detail->supplier_bill_no}}</td>--}}
{{--                            <td>{{$purchase_detail->code}}</td>--}}
{{--                            <td>{{$purchase_detail->items_name}}</td>--}}
{{--                            <td>{{$purchase_detail->type}}</td>--}}
{{--                            <td>{{$purchase_detail->supplier_name}}</td>--}}
{{--                            <td>{{$purchase_detail->qty}}</td>--}}
{{--                            <td>{{$purchase_detail->rate}}</td>--}}
{{--                            <td>{{$purchase_detail->dis_per}}</td>--}}
{{--                            <td>{{$purchase_detail->vat}}</td>--}}
{{--                            <td>{{$purchase_detail->total_amount}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function(){

            var date = new Date();
            console.log(date);


            var _token = $('input[name="_token"]').val();
            console.log(_token);
            fetch_data();

            function fetch_data(from_date = '', to_date = '')
            {
                console.log("fetch data");
                $.ajax({
                    url:"{{ route('get.purchase.reports.fetchdata') }}",
                    type:"POST",
                    data:{from_date:from_date, to_date:to_date, _token:_token},
                    dataType:"json",
                    success:function(data)
                    {
                        // alert('Test');
                        console.log(data);
                        // let data = jQuery.parseJSON(res);
                        // console.log(data);
                        var output = '';
                        $('#total_records').text(data.length);
                        for(var i = 0; i < data.length; i++)
                        {
                        //     output = `<tr>
                        //     <td></td>
                        //     <td>${data[i].received_date}</td>
                        //     <td>${data[i].purchase_no}</td>
                        //     <td>${data[i].supplier_bill_no}</td>
                        //     <td>${data[i].code}</td>
                        //     <td>${data[i].items_name}</td>
                        //     <td>${data[i].type}</td>
                        //     <td>${data[i].supplier_name}</td>
                        //     <td>${data[i].qty}</td>
                        //     <td>${data[i].rate}</td>
                        //     <td>${data[i].dis_per}</td>
                        //     <td>${data[i].vat}</td>
                        //     <td>${data[i].total_amount}</td>
                        // </tr>`;

                        output += '<tr>';
                        // output += '<td></td>';
                        output += '<td>' + data[i].received_date + '</td>';
                        output += '<td>' + data[i].purchase_no + '</td>';
                        output += '<td>' + data[i].supplier_bill_no + '</td>';
                        output += '<td>' + data[i].code + '</td>';
                        output += '<td>' + data[i].items_name + '</td>';
                        output += '<td>' + data[i].type + '</td>';
                        output += '<td>' + data[i].supplier_name + '</td>';
                        output += '<td>' + data[i].qty + '</td>';
                        output += '<td>' + data[i].rate + '</td>';
                        output += '<td>' + data[i].dis_per + '</td>';
                        output += '<td>' + data[i].vat + '</td>';
                        output += '<td>' + data[i].total_amount + '</td>';
                        output += '</tr>';
                        console.log(output);
                        }
                        $('tbody').html(output);
                    }
                })
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
            });
        });
    </script>

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


    {{--    @parent--}}
    <script>
        $(function () {
            let dtButtons = [];
            $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons });
            $('.select-checkbox').css('display','none');
        })
    </script>


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
