@extends('layouts.admin')
@section('page_header')
    Purchase Details Report
@stop
@section('content')

    <div class="card">
        <div class="card-header d-flex">
            <div class="form-group col-3 row">
                <label for="from_date">From Date</label>
                    <input id="from_date"
                           name="from_date"
                           type="text"
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
                       value="BS">
            </div>
            <div class="form-group col-3 row ml-1">
                <label for="to_date">To Date</label>
                <input id="to_date"
                       name="to_date"
                       type="text"
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
                       value="BS">
            </div>
            <div class="form-group col-4 row ml-1">
                <label for="submit">&nbsp</label>
                <input type="submit" id="submit" value="Get"
                       class="form-control btn btn-primary" autofocus>
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
                        <th>Pack Size</th>
                        <th>Rate</th>
                        <th>Discount(%)</th>
                        <th>VAT(%)</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    @foreach($items as $item)--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <td>{{$item->code}}</td>--}}
{{--                            <td>{{$item->name}}</td>--}}
{{--                            <td>{{$item->itemType->type}}</td>--}}
{{--                            <td>{{$item->author}}</td>--}}
{{--                            <td>{{$item->publisher->name}}</td>--}}
{{--                            <td><a type="button" href="/item/{{$item->id}}/edit" class="btn btn-primary">Edit</a></td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section('scripts')
    {{--    @parent--}}
    <script>
        $(function () {
            let dtButtons = [];
            $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons });
            $('.select-checkbox').css('display','none');
        })
    </script>


    {{-- Nepali Date picker--}}
    <script>
        $("#from_date").nepaliDatePicker({
            dateFormat: "%y-%m-%d",
            closeOnDateSelect: true
        });

        var currentDate = new Date();
        var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
        console.log(currentNepaliDate);
        var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        // var formatedNepaliDate = calendarFunctions.bsDateFormat("mm/dd/yyyy", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        console.log(formatedNepaliDate);
        $("#from_date").val(formatedNepaliDate);
    </script>
    <script>
        $("#to_date").nepaliDatePicker({
            dateFormat: "%y-%m-%d",
            closeOnDateSelect: true
        });

        var currentDate = new Date();
        var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
        var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        console.log(formatedNepaliDate);
        $("#to_date").val(formatedNepaliDate);
    </script>
@endsection
@endsection
