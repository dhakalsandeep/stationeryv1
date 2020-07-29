@extends('layouts.admin')
@section('page_header')
Items
@stop
@section('content')
    @can('item_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="form-control btn btn-success" href="{{ route("item.create") }}">
                    <i class="fa fa-plus"></i>
                    {{ trans('global.add') }} New {{ trans('global.item.title_singular') }}
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
                            <th>Code</th>
                            <th>Items Name</th>
                            <th>Items Type</th>
                            <th>R.O. Level</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{$item->code}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->type}}</td>
                            <td class="text-right">{{$item->ro_level}}</td>
                            <td>{{$item->author}}</td>
                            <td>{{$item->publisher_name}}</td>
                            <td><a type="button" href="/item/{{$item->id}}/edit" class="btn btn-primary btn-sm">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section('scripts')
    {{--    @parent--}}
    <script>
        $(function () {

            $('.datatable:not(.ajaxTable)').DataTable();
            // let dtButtons = [];
            // $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons });
            // $('.select-checkbox').css('display','none');
        })
    </script>
@endsection
@endsection
