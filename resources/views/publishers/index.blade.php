@extends('layouts.app2')
@section('page_header')
Publishers
@stop
@section('content')
<div class="container">
    <a type="button" href="{{route('publisher.create')}}" class="btn btn-primary" style="float:right; margin-bottom: 10px; color: #fff">Add New Publisher</a>
    <table class="table table-bordered">
        <tr>
            <th>Publisher</th>
            <th>Country</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        @foreach($publishers as $publisher)
            <tr>
                <td>{{$publisher->name}}</td>
                <td>{{$publisher->country}}</td>
                <td>{{$publisher->address}}</td>
                <td><a type="button" href="/publisher/{{$publisher->id}}/edit" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </table>

</div>
@endsection
