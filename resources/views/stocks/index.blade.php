@extends('layouts.admin')
@section('page_header')
Stock Management
@stop
@section('content')
{{--    @can('supplier_create')--}}
{{--        <div style="margin-bottom: 10px;" class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <a class="btn btn-success" href="{{ route("supplier.create") }}">--}}
{{--                    {{ trans('global.add') }} {{ trans('global.supplier.title_singular') }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endcan--}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Purchase No</th>
                            <th>Items Name</th>
                            <th>Edition</th>
                            <th>Room No</th>
                            <th>Rack No</th>
                            <th>Total Qty</th>
                            <th>Current Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td></td>
                            <td>{{$stock->purchase_detail->purchase_no}}</td>
                            <td>{{$stock->item->name}}</td>
                            <td>{{$stock->edition}}</td>
                            <td>{{$stock->room_no}}</td>
                            <td>{{$stock->rack_no}}</td>
                            <td>{{$stock->qty}}</td>
                            <td>{{$stock->cur_qty}}</td>
                            <td><a type="button" href="{{ route('stock.edit',$stock->id) }}" class="btn btn-primary">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
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
@endsection
@endsection
