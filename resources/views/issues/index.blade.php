@extends('layouts.app2')
@section('page_header')
Issued Items
@stop
@section('content')
<div class="container">
    <a type="button" href="{{ route('issue.create')}}" class="btn btn-primary" style="float:right; margin-bottom: 10px; color: #fff">Add Issue</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center" width="40%">Items Name</th>
                <th class="text-center" width="10%">Issue Qty</th>
                <th class="text-center" width="10%">Issue Date</th>
                <th class="text-center" width="25%">Issued Department</th>
                <th class="text-center" width="15%">Action</th>
            </tr>
        </thead>
        @foreach($issues as $issue)
            <tr>
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
    </table>

</div>
@endsection
