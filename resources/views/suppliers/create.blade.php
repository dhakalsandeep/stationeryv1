@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header font-weight-bold" style="font-size: 200%;">Add New Supplier</div>

    <div class="card-body">
        <form action="/supplier" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label">Supplier Name</label>
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

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label">Address</label>
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

            <div class="form-group row">
                <label for="phoneno" class="col-md-4 col-form-label">Phone No</label>
                <input id="phoneno"
                       name="phoneno"
                       type="number"
                       class="form-control
                        @error('phoneno') is-invalid
                         @enderror"
                       value="{{ old('phoneno') }}"
                       autocomplete="phoneno" autofocus>
                @error('phoneno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label">Email</label>
                <input id="email"
                       name="email"
                       type="email"
                       class="form-control
                        @error('email') is-invalid
                         @enderror"
                       value="{{ old('email') }}"
                       autocomplete="email" autofocus>
                @error('email')
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
@endsection
