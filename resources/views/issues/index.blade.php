@extends('layouts.admin')

@section('page_header')
Issued Items
@stop
@section('content')
    @can('issue_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("issue.create") }}">
                    {{ trans('global.add') }} {{ trans('global.issue.title_singular') }}
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
                            <th style="display: none"></th>
                            <th class="text-center" width="40%">Items Name</th>
                            <th class="text-center" width="10%">Issue Qty</th>
                            <th class="text-center" width="10%">Issue Date</th>
                            <th class="text-center" width="25%">Issued Department</th>
                            <th class="text-center" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($issues as $issue)
                        <tr>
                            <td style="display: none"></td>
                            <td class="text-left">{{$issue->item->name}}</td>
                            <td class="text-right">{{$issue->qty}}</td>
                            <td class="text-center">{{$issue->issue_date}}</td>
                            <td class="text-center">{{$issue->to_department->name}}</td>
                            <td class="text-left"><a type="button" href="#" class="btn btn-xs btn-primary"><i class="fas fa-pen-square"></i>Edit</a>
            {{--                    <a type="button" href="#" class="btn btn-xs btn-danger"><i class="fas fa-pen-square"></i> Delete</a>--}}
            {{--                    <a type="button" href="{{route('issue.print',$issue->id)}}"--}}
            {{--                       class="btn btn-xs btn-primary"><i class="fas fa-pen-square"></i>Print</a>--}}
                            </td>
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
