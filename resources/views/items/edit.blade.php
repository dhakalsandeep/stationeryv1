@extends('layouts.admin')
@section('page_header')
    Publishers
@stop
@section('content')
<div class="container">
    <form action="/item/{{$item->id}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group row">
                    <label for="code" class="col-md-4 col-form-label">Items Code</label>
                    <input id="code"
                           name="code"
                           type="text"
                           style="text-transform:uppercase"
                           class="form-control
                            @error('code') is-invalid
                             @enderror"
                           value="{{ $item->code }}"
                           autocomplete="code"
                    READONLY>
                    @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Items Name</label>
                    <input id="name"
                           name="name"
                           type="text"
                           style="text-transform:uppercase"
                           class="form-control
                            @error('name') is-invalid
                             @enderror"
                           value="{{ $item->name }}"
                           autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="items_type" class="col-md-4 col-form-label">Items Type</label>
                    <select name="items_types_id" id="items_type" class="form-control">
                        <option value=""></option>
                        @foreach($itemsTypes as $itemsType)
                            <option value="{{$itemsType->id}}" @if($itemsType->id == $item->items_types_id) selected @endif>{{$itemsType->type}}</option>
                        @endforeach
                    </select>
                    @error('items_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="isbn" class="col-md-4 col-form-label">ISBN</label>
                    <input id="isbn"
                           name="isbn"
                           type="text"
                           class="form-control
                            @error('isbn') is-invalid
                             @enderror"
                           value="{{ $item->isbn }}"
                           autocomplete="isbn" autofocus>
                    @error('isbn')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="ro_level" class="col-md-4 col-form-label">Re-Order Level</label>
                    <input id="ro_level"
                           name="ro_level"
                           type="number"
                           onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                           class="form-control
                        @error('ro_level') is-invalid
                         @enderror"
                           value="{{ $item->ro_level}}"
                           autocomplete="ro_level" autofocus>
                    @error('ro_level')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="author" class="col-md-4 col-form-label">Author</label>
                    <input id="author"
                           name="author"
                           type="author"
                           style="text-transform:uppercase"
                           class="form-control
                            @error('author') is-invalid
                             @enderror"
                           value="{{ $item->author }}"
                           autocomplete="author" autofocus>
                    @error('author')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="publisher" class="col-md-4 col-form-label">Publisher</label>
                    <select name="publishers_id" id="publisher" class="form-control">
                        <option value=""></option>
                        @foreach($publishers as $publisher)
                            <option value="{{$publisher->id}}" @if($publisher->id == $item->publishers_id) selected @endif>{{$publisher->name}}</option>
                        @endforeach
                    </select>
                    @error('publisher')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row pt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
