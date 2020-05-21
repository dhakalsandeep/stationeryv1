@extends('layouts.app2')
@section('page_header')
Suppliers
@stop
@section('content')
<div class="container">
    <a type="button" href="{{route('supplier.create')}}" class="btn btn-primary" style="float:right; margin-bottom: 10px; color: #fff">Add New Supplier</a>
    <table class="table table-bordered">
        <tr>
            <th>Supplier</th>
            <th>Address</th>
            <th>Phone No</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach($suppliers as $supplier)
            <tr>
                <td>{{$supplier->name}}</td>
                <td>{{$supplier->address}}</td>
                <td>{{$supplier->phoneno}}</td>
                <td>{{$supplier->email}}</td>
                <td><a type="button" href="/supplier/{{$supplier->id}}/edit" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </table>

</div>
@endsection
