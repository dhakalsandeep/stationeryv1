@extends('layouts.admin')
@section('page_header')
Suppliers
@stop
@section('content')
    @can('supplier_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("supplier.create") }}">
                    {{ trans('global.add') }} {{ trans('global.supplier.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Address</th>
                            <th>Phone No</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->address}}</td>
                            <td>{{$supplier->phoneno}}</td>
                            <td>{{$supplier->email}}</td>
                            <td><a type="button" href="/supplier/{{$supplier->id}}/edit" class="btn btn-primary">Edit</a></td>
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
            $('.datatable:not(.ajaxTable)').DataTable();
        })
    </script>
@endsection
@endsection
