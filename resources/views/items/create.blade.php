@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header font-weight-bold" style="font-size: 200%;">Add New Item/Book</div>

    <div class="card-body">
        <form action="/item" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group row">
                <label for="code" class="col-md-4 col-form-label">Items Code</label>
                <input id="code"
                       name="code"
                       type="text"
                       style="text-transform:uppercase"
                       class="form-control
                        @error('code') is-invalid
                         @enderror"
                       value="{{ old('code') }}"
                       autocomplete="code" autofocus>
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
                       value="{{ old('name') }}"
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
                    <option value="{{$itemsType->id}}">{{$itemsType->type}}</option>
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
                       value="{{ old('isbn') }}"
                       autocomplete="isbn" autofocus>
                @error('isbn')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="print_date" class="col-md-4 col-form-label">Print Date</label>
                <input id="print_date"
                       name="print_date"
                       type="date"
                       class="form-control
                        @error('print_date') is-invalid
                         @enderror"
                       value="{{ old('print_date') }}"
                       autocomplete="print_date" autofocus>
                @error('print_date')
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
                       value="{{ old('author') }}"
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
                        <option value="{{$publisher->id}}">{{$publisher->name}}</option>
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
        </form>
    </div>
</div>
@section('scripts')
    <script>
        $( "#print_date" ).datepicker();
    </script>
@endsection
@endsection
