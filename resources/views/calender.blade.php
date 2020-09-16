@extends('layouts.admin')
@section('page_header')
    Calender
@stop
{{--@section('content')--}}
{{--<div class="container-fluid m-2">--}}
{{--    <a type="button" href="{{route('purchase.create')}}" class="btn btn-primary" style="float:right; margin-bottom: 10px; color: #fff">Add New Purchase</a>--}}
@section('content')
    <div class="card">
        <div class="card-body">
            <iframe src="https://www.hamropatro.com/widgets/calender-full.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0"
                    style="border:none; overflow:hidden; width:800px; height:840px;" allowtransparency="true"></iframe>
        </div>
    </div>
    </div>
@section("scripts")
@endsection
@endsection
