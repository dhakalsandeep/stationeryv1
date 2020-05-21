@extends('layouts.app2')
@section('page_header')
    Publishers
@stop
@section('content')
<div class="container">
    <form action="/publisher/{{$publisher->id}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Publisher Name</label>
                    <input id="name"
                           name="name"
                           type="text"
                           class="form-control
                            @error('name') is-invalid
                             @enderror"
                           value="{{$publisher->name}}"
                           autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label">Country</label>
                    <input id="country"
                           name="country"
                           type="text"
                           class="form-control
                            @error('country') is-invalid
                             @enderror"
                           value="{{$publisher->country}}"
                           autocomplete="country" autofocus>
                    @error('country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label">Address</label>
                    <input id="address"
                           name="address"
                           type="text"
                           class="form-control
                            @error('address') is-invalid
                             @enderror"
                           value="{{$publisher->address}}"
                           autocomplete="address" autofocus>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">Url</label>
                    <input id="url"
                           name="url"
                           type="url"
                           class="form-control
                            @error('url') is-invalid
                             @enderror"
                           value="{{$publisher->url}}"
                           autocomplete="url" autofocus>
                    @error('url')
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
