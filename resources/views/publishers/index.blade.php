@extends('layouts.admin')
@section('page_header')
    Publishers
@stop
@section('content')
    @can('publisher_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("publisher.create") }}">
                    {{ trans('global.add') }} {{ trans('global.publisher.title_singular') }}
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
                        <th width="10"></th>
                        <th>Publisher</th>
                        <th>Country</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($publishers as $publisher)
                        <tr data-entry-id="{{ $publisher->id }}">
                            <td></td>
                            <td>{{$publisher->name}}</td>
                            <td>{{$publisher->country}}</td>
                            <td>{{$publisher->address}}</td>
                            <td><a type="button" href="/publisher/{{$publisher->id}}/edit"
                                   class="btn btn-primary">Edit</a></td>
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
            let dtButtons = [];
            $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons });
            $('.select-checkbox').css('display','none');
        })
    </script>
@endsection
@endsection
