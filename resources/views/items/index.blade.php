@extends('layouts.app2')
@section('page_header')
Items
@stop
@section('content')
<div class="container">
    <a type="button" href="{{route('item.create')}}" class="btn btn-primary" style="float:right; margin-bottom: 10px; color: #fff">Add New Item</a>
    <table class="table table-bordered">
        <tr>
            <th>Code</th>
            <th>Items Name</th>
            <th>Items Type</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Action</th>
        </tr>
        @foreach($items as $item)
            <tr>
                <td>{{$item->code}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->itemType->type}}</td>
                <td>{{$item->author}}</td>
                <td>{{$item->publisher->name}}</td>
                <td><a type="button" href="/item/{{$item->id}}/edit" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
    </table>

</div>
@endsection
