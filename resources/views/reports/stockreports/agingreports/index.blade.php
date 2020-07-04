@extends('layouts.admin')
@section('page_header')
    Stock Aging Report
@stop
@section('content')

    <div class="card">
        <div class="card-header">
            <form action="/stock-aging-report/print" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-2 row justify-content-center">
                        <label for="range_day_one">Range Day One</label>
                        <input id="range_day_one"
                               name="range_day_one"
                               type="number"
                               max="10"
                               onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                               class="form-control"
                               value="{{ old('range_day_one') }}"
                               autocomplete="range_day_one" autofocus>
                        @error('range_day_one')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group col-2 row ml-1 justify-content-center">
                        <label for="range_day_two">Range Day Two</label>
                        <input id="range_day_two"
                               name="range_day_two"
                               type="number"
                               max="10"
                               onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                               class="form-control"
                               value="{{ old('range_day_two') }}"
                               autocomplete="range_day_two" autofocus>
                        @error('range_day_two')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group col-2 row ml-1 justify-content-center">
                        <label for="range_day_three">Range Day Three</label>
                        <input id="range_day_three"
                               name="range_day_three"
                               type="number"
                               max="10"
                               onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                               class="form-control"
                               value="{{ old('range_day_three') }}"
                               autocomplete="range_day_three" autofocus>
                        @error('range_day_three')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group col-3 row ml-1">
                        <label for="btn_get_data">&nbsp</label>
                        <input type="button" id="btn_get_data" value="Get"
                               class="form-control btn btn-primary" autofocus>
                    </div>
                    <div class="form-group col-3 row ml-1">
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
                    <thead class="text-center">
                    <tr>
                        <th rowspan="2"  style="vertical-align: middle;">Code</th>
                        <th rowspan="2"  style="vertical-align: middle;">Items Name</th>
                        <th rowspan="2"  style="vertical-align: middle;">Edition</th>
                        <th colspan="2" id="day_range_one">0 - 30 Days</th>
                        <th colspan="2" id="day_range_two">30 - 60 Days</th>
                        <th colspan="2" id="day_range_three">60 - 90 Days</th>
                        <th colspan="2" id="day_range_four">Above 90 Days</th>
                        <th colspan="2">Balance</th>
                    </tr>
                    <tr>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Amount</th>
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
            let range_day_one = $('#range_day_one').val() ? $('#range_day_one').val() : 30;
            let range_day_two = $('#range_day_two').val() ? $('#range_day_two').val() : 60;
            let range_day_three = $('#range_day_three').val() ? $('#range_day_three').val() : 90;
            $('#range_day_one').val(range_day_one);
            $('#range_day_two').val(range_day_two);
            $('#range_day_three').val(range_day_three);

            function init() {
                range_day_one = $('#range_day_one').val();
                range_day_two = $('#range_day_two').val();
                range_day_three = $('#range_day_three').val();
                document.getElementById('day_range_one').innerText = `0 - ${range_day_one} Days`;
                document.getElementById('day_range_two').innerText = `${range_day_one} - ${range_day_two} Days`;
                document.getElementById('day_range_three').innerText = `${range_day_two} - ${range_day_three} Days`;
                document.getElementById('day_range_four').innerText = `Above ${range_day_three} Days`;
                console.log(range_day_one,range_day_two,range_day_three);
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            fetch_data();


            function fetch_data()
            {
                console.log(range_day_one,range_day_two,range_day_three);
                console.log("fetch data");

                $('#datatable').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    // pageLength: 100,

                    ajax: {
                        url: "{{ route('get.stock.aging.reports.fetchdata') }}",
                        type: 'GET',
                        data: function (d) {
                            d.range_day_one = range_day_one;
                            d.range_day_two = range_day_two;
                            d.range_day_three = range_day_three;
                        },

                    },
                    columns:[
                        { data: "code",name: "code" ,className: "text-left"},
                        { data: "items_name",name: "items_name",className: "text-left" },
                        { data: "edition",name: "edition",className: "text-left" },
                        { data: "qty1",name: "qty1" ,className: "text-right" },
                        { data: "amount1",name: "amount1" ,className: "text-right"},
                        { data: "qty2",name: "qty2" ,className: "text-right"},
                        { data: "amount2",name: "amount2" ,className: "text-right"},
                        { data: "qty3",name: "qty3" ,className: "text-right"},
                        { data: "amount3",name: "amount3" ,className: "text-right"},
                        { data: "qty4",name: "qty4" ,className: "text-right"},
                        { data: "amount4",name: "amount4" ,className: "text-right"},
                        { data: "qty5",name: "qty5" ,className: "text-right"},
                        { data: "amount5",name: "amount5" ,className: "text-right"},
                    ],
                });
            }

            $('#btn_get_data').click(function(){
                init();
                fetch_data();
                // $('#datatable').DataTable().draw(true);
            });
        })
    </script>
@endsection
@endsection
