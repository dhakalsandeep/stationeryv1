@extends('layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold" style="font-size: 200%;">Add Issue Detail</div>

                <div class="card-body">
                    <form action="{{route('issue.store')}}" enctype="multipart/form-data" id="issue_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 d-flex" style="justify-content: space-between;margin: auto 0;">
                                <div class="form-group col-md-2 row justify-content-center">
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

                                <div class="form-group col-md-2 ml-3 row justify-content-center">
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

                                <div class="form-group col-md-4 ml-3 row justify-content-center">
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

                                <div class="form-group col-md-4 row ml-3 justify-content-center">
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
                            <div class="col-md-12 d-flex" style="justify-content: space-between;margin: auto 0;">
                                <div class="form-group col-md-6 row" style="margin: auto 0;padding: 0;">
                                    <label for="item" style="margin: auto 0;">Item Name</label>
                                </div>

                                <div class="form-group col-md-3 row" style="margin: auto 0;padding: 0;">
                                    <label for="edition" style="margin: auto 0;">Edition</label>
                                </div>

                                <div class="form-group col-md-2 row" style="margin: auto 0;padding: 0;">
                                    <label for="qty" style="margin: auto 0;">Qty</label>
                                </div>
                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <label for="removeDetail" style="margin: auto 0;">&nbsp;</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex issue-detail pt-2" style="justify-content: space-between;margin: auto 0;">
                                <div class="form-group col-md-6 row pr-3" style="margin: auto 0;padding: 0;">
                                    <select class="form-control" name="issue_details_id[]" id="issue_details_id">
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

                                <div class="form-group col-md-3 row pr-3" style="margin: auto 0;padding: 0;">
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

                                <div class="form-group col-md-2 row pr-3" style="margin: auto 0;padding: 0;">
                                    <input id="qty"
                                           name="qty[]"
                                           max="10"
                                           onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                           type="number"
                                           class="form-control qty"
                                           value="{{ old('qty') }}"
                                           autocomplete="qty" autofocus>
                                    @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-1 row" style="margin: auto 0;padding: 0;">
                                    <button class="form-control btn btn-danger" id="removeDetail"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>

                            <div class="col-md-12 add-detail-btn-wrapper pt-2" style="width: 100%; text-align: right">
                                <button class="form-control btn btn-primary btn-xs" id="addDetail"><i class="fa fa-plus"></i> </button>
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
@endsection

@section('scripts')
    <script>
        $(function () {
            let qty;
            qty=$(".qty");
            $( ".qty" ).change(function(){
                id = $(this).attr("id");
                if (validateQty(id)) {

                };
            });
            qty.keyup(function(){
                id = $(this).attr("id");
                if (validateQty(id)) {
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
                    return false;
                }
                return true;
            }
        });
    </script>
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
{{--    Convert Nepali date to roman date--}}
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

    {{--     Add and remove issue detail--}}
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

    {{--     Nepali Date picker--}}
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


{{--     On change Item change--}}
    <script>
        $(document).on('change', '#issue_details_id', function () {
            let $div = $(this).closest('.issue-detail');
            let issue_details_id = $div.find('#issue_details_id').val();
            let idVal = $div.find(".qty").attr("id");
            let idStr = `qty-${issue_details_id}`;
            let qtyID = document.getElementById(idVal);
            qtyID.id = idStr;
            let url = '{{route('get.items.edition',123)}}';
            url = url.replace('123', issue_details_id);
            // console.log(url);
            $.ajax({
                method: 'get',
                url: url,
                success: function (res) {
                    if (res != '') {
                        let stock = jQuery.parseJSON(res);
                        // console.log(stock);
                        $div.find("#edition").val(stock.edition);
                        $div.find(".qty").val(stock.cur_qty);
                        $div.find(".qty").attr({
                            "max" : stock.cur_qty,
                            "min" : 1
                        });
                        // $( "#myselect option:selected" ).text();

                        let str = $div.find( "#issue_details_id option:selected" ).text();
                        let n = str.indexOf("|");
                        let issue_details = str.split("|");
                        let issue_detail_text = issue_details[0];
                        // console.log(issue_detail_text);
                        $div.find("#issue_details_id option:selected").text(issue_detail_text);
                    } else {
                        $('input#edition').val('');
                    }

                }

            })
        })
    </script>

    {{--     On From Department change--}}
    <script>
        $(document).on('change', '#from_department_id', function () {
            let from_dep_id = $('#from_department_id').val();
            // console.log(from_dep_id);
            if (from_dep_id == 1) {
                $('select#to_department_id').val(2);
            }
            else if (from_dep_id == 2) {
                $('select#to_department_id').val(1);
            }
            else {
                $('select#to_department_id').val(0);
            }
        })
    </script>

    {{--     On To Department change--}}
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
