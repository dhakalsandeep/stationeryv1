@extends('layouts.admin')
@section('page_header')
    Current Stock Report
@stop
@section('content')

    <div class="card">
        <div class="card-header">
            <form action="{{ route('current.stock.report.print') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row" style="margin:0 auto;justify-content: space-between;">
                    <div class="form-group col-4 justify-content-center">
                        <label for="department">From Department</label>
                        <select class="form-control" name="department_id" id="department_id">
                            {{--                        <option value=0>------</option>--}}
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-4 row">
                        <label for="from_date">&nbsp</label>
                        <select class="form-control" name="report_type" id="report_type">
                            <option value="1">Currently Available</option>
                            <option value="2">Below Reorder Level</option>
                        </select>
                        @error('report_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="form-group col-2 row">
                        <label for="btn_get_data">&nbsp</label>
                        <input type="button" id="btn_get_data" value="Get"
                               class="form-control btn btn-primary" autofocus>
                    </div>
                    <div class="form-group col-2 row">
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
                        <th>Code</th>
                        <th>Item Name</th>
                        <th>Edition</th>
                        <th>Item Type</th>
                        <th>Current Stock</th>
                        <th>R.O. Level</th>
                        <th>Rate</th>
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
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            fetch_data();


            function fetch_data(department_id = 1, report_type = 1)
            {
                console.log("fetch data");

                $('#datatable').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    // pageLength: 100,

                    ajax: {
                        url: "{{ route('get.current.stock.report.fetchdata') }}",
                        type: 'GET',
                        data: function (d) {
                            d.department_id = department_id;
                            d.report_type = report_type;
                        },

                    },
                    columns:[
                        { data: "code",name: "code", className:"text-left" },
                        { data: "items_name",name: "items_name", className:"text-left" },
                        { data: "edition",name: "edition", className:"text-left" },
                        { data: "type",name: "type", className:"text-left" },
                        { data: "current_stock",name: "current_stock", className:"text-right" },
                        { data: "ro_level",name: "ro_level", className:"text-right" },
                        { data: "rate",name: "rate", className:"text-right" },
                        { data: "dis_per",name: "dis_per", className:"text-right" },
                        { data: "vat",name: "vat", className:"text-right" },
                        { data: "total_amount",name: "total_amount", className:"text-right" },
                    ],
                });
            }
            $('#report_type').change(function () {
                get_data()
            });
            $('#btn_get_data').click(function () {
                get_data()
            });

            // $('#report_type').change(() => get_data());
            // $('#btn_get_data').click(() => get_data());
            function get_data() {
                let department_id = parseInt($('#department_id').val());
                let report_type = parseInt($('#report_type').val());
                if(department_id != '' &&  report_type != '')
                {
                    console.log(department_id,report_type);
                    fetch_data(department_id,report_type);
                }
                else
                {
                    alert('Both Date is required');
                }
            }

        })
    </script>

@endsection
@endsection
