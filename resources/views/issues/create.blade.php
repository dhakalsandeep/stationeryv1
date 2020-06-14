@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header font-weight-bold" style="font-size: 200%;">Add Issue Detail</div>

    <div class="card-body">
        <form action="{{route('issue.store')}}" enctype="multipart/form-data" id="issue_form" method="post">
            @csrf
            <div class="row">
                <div class="d-flex">
                    <div class="form-group col-2 row justify-content-center">
                        <label for="fiscal_year">Fiscal Year</label>
                        <input id="fiscal_year"
                               name="fiscal_year"
                               type="text"
                               class="form-control font-weight-bold"
                               value="{{ $fiscal_year->fiscal_year }}"
                               readonly
                               autocomplete="fiscal_year" autofocus>
                        @error('fiscal_year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-2 ml-3 row justify-content-center">
                        <label for="issue_date">Issue Date</label>
                        <input id="issue_date"
                               name="issue_date"
                               type="text"
                               class="form-control"
                               value="{{ old('issue_date') }}"
                               autocomplete="issue_date" autofocus>
                        @error('issue_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-4 ml-3 row justify-content-center">
                        <label for="from_department">From Department</label>
                        <select class="form-control" name="from_department_id" id="from_department_id">
    {{--                        <option value=0>------</option>--}}
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        @error('from_department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-4 row ml-3 justify-content-center">
                        <label for="to_department">To Department</label>
                        <select class="form-control" name="to_department_id" id="to_department_id">
    {{--                        <option value=0>-------</option>--}}
                            @foreach($departments as $department)
                                <option value="{{$department->id}}" selected="2">{{$department->name}}</option>
                            @endforeach
                        </select>
                        @error('to_department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex issue-detail">
                    <div class="form-group col-md-6 row">
                        <label for="item">Item Name</label>
                        <select class="form-control" name="items_management_id[]" id="items_management_id">
                            <option value="">...............</option>
                            @foreach($stocks as $stock)
                                <option value="{{$stock->id}}">{{ $stock->item->name }}|{{ $stock->edition }}|{{ $stock->cur_qty }}</option>
                            @endforeach
                        </select>
                        @error('item')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 row pl-3">
                        <label for="edition">Edition</label>
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

                    <div class="form-group col-md-2 row pl-3">
                        <label for="qty">Qty</label>
                        <input id="qty"
                               name="qty[]"
                               type="number"
                               max="10"
                               onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                               class="form-control"
                               value="{{ old('qty') }}"
                               autocomplete="qty" autofocus>
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <button class="btn btn-danger btn-xs" id="removeDetail" style="position: absolute;right: -14px;bottom: 9px;"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="add-detail-btn-wrapper" style="width: 100%;">
                    <button class="btn btn-primary btn-xs" id="addDetail"><i class="fa fa-plus"></i> </button>
                </div>


{{--            <div class="col-md-12 row">--}}
{{--                <div class="form-group d-flex pt-4">--}}
{{--                    <button type="submit" name="btn_save_data" id="btn_save_data" class="btn btn-primary">--}}
{{--                        <i class="fa fa-save"></i> Save--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
                <div class="form-group pt-4">
                    <button type="submit" name="btn_save_data" id="btn_save_data" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#btn_save_data', function (e) {
            e.preventDefault();
            console.clear();
            let date_nep = $('#issue_date').val();
            //console.log(date_nep);
            let date_roman = convertNepaliToEnglish(date_nep);
            $('#issue_date').val(date_roman);
            console.log($('#issue_date').val());
            $('#issue_form').submit();


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

    {{-- Add and remove issue detail--}}
    <script>
        console.clear();
        $('#addDetail').click(function (e) {
            e.preventDefault();
            let $issueDetail = $('.issue-detail').first().clone(true); // if you want to clone events also, add true in clone(true)
            //$issueDetail.find('label').remove();
            $issueDetail.find('input').val('');
            // $issueDetail.find('select').val('');
            $('.issue-detail').last().after($issueDetail);
            console.log(issueDetail);
        });
        $('#removeDetail').click(function (e) {
            e.preventDefault();
            let $details = $('.issue-detail');
            if($details.length > 1){
                $(this).closest('.issue-detail').remove();
            }else{
                alert("Can not delete first")
            }
        });
    </script>

    {{-- Nepali Date picker--}}
    <script>
        $("#issue_date").nepaliDatePicker({
            dateFormat: "%y-%m-%d",
            closeOnDateSelect: true
        });

        var currentDate = new Date();
        console.log(currentDate);
        var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
        console.log(currentNepaliDate);
        var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        //console.log(formatedNepaliDate);
        $("#issue_date").val(formatedNepaliDate);
    </script>

    {{-- Nepali Date Picker --}}
    <script>
        $("#received_date").nepaliDatePicker({
            dateFormat: "%y-%m-%d",
            closeOnDateSelect: true
        });

        var currentDate = new Date();
        var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
        var formatedNepaliDate = calendarFunctions.bsDateFormat("%y-%m-%d", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        $("#received_date").val(formatedNepaliDate);
    </script>

    {{-- On change Item change--}}
    <script>
        $(document).on('change', '#items_management_id', function () {
            let $div = $(this).closest('.issue-detail');
            let items_management_id = $div.find('#items_management_id').val();
            let url = '{{route('get.items.edition',123)}}';
            url = url.replace('123', items_management_id);
            $.ajax({
                method: 'get',
                url: url,
                success: function (res) {
                    if (res != '') {
                        let stock = jQuery.parseJSON(res);
                        console.log(stock.edition);
                        $div.find("#edition").val(stock.edition);
                        $div.find("#qty").val(stock.cur_qty);
                        $div.find("#qty").attr({
                            "max" : stock.cur_qty,
                            "min" : 1
                        });
                    } else {
                        $('input#edition').val('');
                    }

                }

            })
        })
    </script>

    {{-- On From Department change--}}
    <script>
        $(document).on('change', '#from_department_id', function () {
            let from_dep_id = $('#from_department_id').val();
            if (from_dep_id === 1) {
                $('select#to_department_id').val(2);
            }
            else if (from_dep_id === 2) {
                $('select#to_department_id').val(1);
            }
            else {
                $('select#to_department_id').val(0);
            }
        })
    </script>

    {{-- On To Department change--}}
    <script>
        $(document).on('change', '#to_department_id', function () {
            let to_dep_id = $('#to_department_id').val();
            if (to_dep_id == 1) {
                $('select#from_department_id').val(2);
            }
            else if (to_dep_id == 2) {
                $('select#from_department_id').val(1);
            }
            else {
                $('select#from_department_id').val(0);
            }
        })
    </script>




@stop
