@extends('layouts.admin')
@section('styles')
    <style>
        .table th,td { padding: 2px;}
    </style>
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold" style="font-size: 200%;">Set Stock Room and Rack</div>

    <div class="card-body">
        <form action="{{ route('stock.update',$stock->id) }}" enctype="multipart/form-data" method="post">
            @csrf

                    <div class="form-group row">
                        <label for="purchase_no" class="col-4 col-form-label">Purchase No</label>
                        <input id="purchase_no"
                               name="purchase_no"
                               type="text"
                               readonly
                               class="form-control
                                @error('purchase_no') is-invalid
                                 @enderror"
                               value="{{$stock->purchase_detail->purchase_no}}"
                               autocomplete="purchase_no" autofocus>
                        @error('purchase_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="item" class="col-4 col-form-label">Item</label>
                        <input id="item"
                               name="item"
                               type="text"
                               readonly
                               class="form-control
                                @error('item') is-invalid
                                 @enderror"
                               value="{{$stock->item->name}}"
                               autocomplete="item" autofocus>
                        @error('item')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="edition" class="col-4 col-form-label">Edition</label>
                        <input id="edition"
                               name="edition"
                               type="text"
                               readonly
                               class="form-control
                                @error('edition') is-invalid
                                 @enderror"
                               value="{{$stock->edition}}"
                               autocomplete="edition" autofocus>
                        @error('edition')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-4 col-form-label">Qty</label>
                        <input id="qty"
                               name="qty"
                               type="text"
                               readonly
                               class="form-control
                                @error('qty') is-invalid
                                 @enderror"
                               value="{{$stock->qty}}"
                               autocomplete="qty" autofocus>
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row">
                        <table class="table table-borderless">
    {{--                        <thead>--}}
    {{--                        <tr class="text-center">--}}
    {{--                            <th>Room No</th>--}}
    {{--                            <th>Rack No</th>--}}
    {{--                            <th>Qty</th>--}}
    {{--                            <th></th>--}}
    {{--                        </tr>--}}
    {{--                        </thead>--}}
                            <tbody>
                                <tr>
                                    <td><input id="input_room_no"
                                               name="input_room_no"
                                               type="text"
                                               class="form-control
                                            @error('input_room_no') is-invalid
                                             @enderror"
                                               value=""
                                               autocomplete="room_no" autofocus>
                                    </td>
                                    <td><input id="input_rack_no"
                                               name="input_rack_no"
                                               type="text"
                                               class="form-control
                                            @error('input_rack_no') is-invalid
                                             @enderror"
                                               value=""
                                               autocomplete="room_no" autofocus>
                                    </td>
                                    <td><input id="input_rack_qty"
                                               name="input_rack_qty"
                                               type="text"
                                               class="form-control
                                            @error('input_rack_qty') is-invalid
                                             @enderror"
                                               value=""
                                               autocomplete="room_no" autofocus>
                                    </td>
                                    <td><button class="btn btn-primary btn-xs" style="margin-top: 7px;" id="addDetail"><i class="fa fa-plus"></i> </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Room No</th>
                                    <th>Rack No</th>
                                    <th>Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="room-rack-detail">
                            @if($details->count() > 0)
                                @foreach($details as $index => $detail)
                                    <tr class="stock-detail">
                                        <td>
                                            <input id="room_no"
                                                   name="room_no[]"
                                                   type="text"
                                                   class="form-control
                                            @error('room_no') is-invalid
                                             @enderror"
                                                   value="{{$detail->room_no}}"
                                                   autocomplete="room_no" autofocus>
                                            @error('room_no')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="rack_no"
                                                   name="rack_no[]"
                                                   type="text"
                                                   class="form-control
                                            @error('rack_no') is-invalid
                                             @enderror"
                                                   value="{{$detail->rack_no}}"
                                                   style= "margin-right: 38px;"
                                                   autocomplete="rack_no" autofocus>
                                            @error('rack_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="rack_qty"
                                                   name="rack_qty[]"
                                                   type="number"
                                                   class="form-control
                                            @error('rack_qty') is-invalid
                                             @enderror"
                                                   value="{{ $detail->qty }}"
                                                   autocomplete="rack_qty" autofocus>
                                            @error('rack_qty')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                        <td><button class="btn btn-danger btn-xs" id="removeDetail" style="margin-top: 7px;"><i class="fa fa-times"></i></button></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

    {{--                <div class="form-group row col-1 add-detail-btn-wrapper" style="width: 100%;">--}}
    {{--                    <button class="btn btn-primary btn-xs" id="addDetail"><i class="fa fa-plus"></i> </button>--}}
    {{--                </div>--}}

                    <div class="form-group row pt-4 js--submit">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            //nothing
        });
        console.clear();
        $('#addDetail').click(function (e) {
            e.preventDefault();
            let room_no = $('#input_room_no').val();
            let rack_no = $('#input_rack_no').val();
            let qty = $('#input_rack_qty').val();
            console.log(room_no,rack_no,qty);
            let html = `
            <tr class="stock-detail">
                <td>
                    <input id="room_no"
                        name="room_no[]"
                        type="text"
                        class="form-control
                        @error('room_no') is-invalid
                        @enderror"
                        value=${room_no}
                    autocomplete="room_no" autofocus>
                    @error('room_no')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
                <td>
                    <input id="rack_no"
                        name="rack_no[]"
                        type="text"
                        class="form-control
                        @error('rack_no') is-invalid
                        @enderror"
                        value=${rack_no}
                        style= "margin-right: 38px;"
                    autocomplete="rack_no" autofocus>
                    @error('rack_no')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
                <td>
                    <input id="rack_qty"
                        name="rack_qty[]"
                        type="number"
                        class="form-control
                        @error('rack_qty') is-invalid
                        @enderror"
                        value=${qty}
                    autocomplete="rack_qty" autofocus>
                    @error('rack_qty')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
                <td>
                    <button class="btn btn-danger btn-xs"
                    id="removeDetail"
                    style="margin-top: 7px;">
                    <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>`

            document.querySelector('.room-rack-detail').insertAdjacentHTML("beforeend", html);
        });

        // $('#addDetail').click(function (e) {
        //     e.preventDefault();
        //     let room_no = $('#input_room_no').val();
        //     let rack_no = $('#input_rack_no').val();
        //     let rack_qty = $('#input_rack_qty').val();
        //     let $stockDetail = $('.stock-detail').first().clone(true); // if you want to clone events also, add true in clone(true)
        //     $stockDetail.find('input').val('');
        //     $('.stock-detail').last().after($stockDetail);
        //     console.log(stockDetail);
        // });
        $('#removeDetail').click(function (e) {
            e.preventDefault();
            let $details = $('.stock-detail');
            console.log("here");
            if($details.length > 1){
                $(this).closest('.stock-detail').remove();
            }else{
                alert("Can not delete first")
            }
        })
    </script>
@stop
