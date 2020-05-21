@extends('layouts.app2')
@section('page_header')
Stock Management
@stop
@section('content')
<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Purchase No</th>
            <th>Items Name</th>
            <th>Edition</th>
            <th>Room No</th>
            <th>Rack No</th>
            <th>Total Qty</th>
            <th>Current Qty</th>
            <th>Action</th>
        </tr>
        @foreach($stocks as $stock)
            <tr>
                <td>{{$stock->purchase_detail->purchase_no}}</td>
                <td>{{$stock->item->name}}</td>
                <td>{{$stock->edition}}</td>
                <td>{{$stock->room_no}}</td>
                <td>{{$stock->rack_no}}</td>
                <td>{{$stock->qty}}</td>
                <td>{{$stock->cur_qty}}</td>
{{--                <td><a type="button" href="/stock/{{$stock->id}}/edit" class="btn btn-primary">Edit</a></td>--}}
                <td><a type="button" href="{{ route('stock.edit',$stock->id) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </table>

</div>
@endsection
