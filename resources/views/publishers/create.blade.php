@extends('layouts.admin')
@section('styles')
    <style>
    label { font-size: 120%;}
    </style>
@endsection

@section('content')
<div class="card">
    <div class="card-header font-weight-bold" style="font-size: 200%;">Add New Publisher</div>

    <div class="card-body">
        <form action="{{ route('publisher.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Publisher Name</label>
                    <input id="name"
                           name="name"
                           type="text"
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

            <div class="form-group">
                <label for="country">Country</label>
                <input id="country"
                       name="country"
                       type="text"
                       class="form-control
                        @error('country') is-invalid
                         @enderror"
                       value="{{ old('country') }}"
                       autocomplete="country" autofocus>
                @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input id="address"
                       name="address"
                       type="text"
                       class="form-control
                        @error('address') is-invalid
                         @enderror"
                       value="{{ old('address') }}"
                       autocomplete="address" autofocus>
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="url">Url</label>
                <input id="url"
                       name="url"
                       type="url"
                       class="form-control
                        @error('url') is-invalid
                         @enderror"
                       value="{{ old('url') }}"
                       autocomplete="url" autofocus>
                @error('url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>



@endsection
