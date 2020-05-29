@extends('layouts.admin')
@section('page_header')
    Set Stock Room and Rack
@stop
@section('content')
    <div class="container">
        <form action="{{ route('stock.update',$stock->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
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

                    @if($details->count() > 0)
                        @foreach($details as $index => $detail)
                            <div class="col-12 d-flex stock-detail">

                                <div class="form-group row">
                                    @if($index==0)
                                        <label for="room_no" class="col-4 col-form-label">Room No</label>
                                    @endif
                                    <input id="room_no"
                                           name="room_no[]"
                                           type="text"
                                           class="form-control
                                        @error('room_no') is-invalid
                                         @enderror"
                                           value="{{$detail->room_no}}"
                                           style= "margin-right: 30px;"
                                           autocomplete="room_no" autofocus>
                                    @error('room_no')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    @if($index == 0)
                                        <label for="rack_no" class="col-4 col-form-label">Rack No</label>
                                    @endif
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
                                </div>

                                <div class="form-group row">
                                    @if($index==0)
                                        <label for="rack_qty" class="col-3 col-form-label">Qty</label>
                                    @endif
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
                                </div>

                                <div class="form-group row">
                                    <button class="btn btn-danger btn-xs" id="removeDetail" style="height: 26px;
                            position: absolute;
                            margin-left: 25px;
                            margin-top: 43px;
                            width: 27px;"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 d-flex stock-detail">
                            <div class="form-group row">
                                <label for="room_no" class="col-4 col-form-label">Room No</label>
                                <input id="room_no"
                                       name="room_no[]"
                                       type="text"
                                       class="form-control
                                    @error('room_no') is-invalid
                                     @enderror"
                                       value="{{$stock->room_no}}"
                                       style= "margin-right: 30px;"
                                       autocomplete="room_no" autofocus>
                                @error('room_no')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="rack_no" class="col-4 col-form-label">Rack No</label>
                                <input id="rack_no"
                                       name="rack_no[]"
                                       type="text"
                                       class="form-control
                                    @error('rack_no') is-invalid
                                     @enderror"
                                       value="{{$stock->rack_no}}"
                                       style= "margin-right: 38px;"
                                       autocomplete="rack_no" autofocus>
                                @error('rack_no')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="rack_qty" class="col-3 col-form-label">Qty</label>
                                <input id="rack_qty"
                                       name="rack_qty[]"
                                       type="number"
                                       class="form-control
                                    @error('rack_qty') is-invalid
                                     @enderror"
                                       value="{{ 0 }}"
                                       autocomplete="rack_qty" autofocus>
                                @error('rack_qty')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <button class="btn btn-danger btn-xs" id="removeDetail" style="height: 26px;
                        position: absolute;
                        margin-left: 25px;
                        margin-top: 43px;
                        width: 27px;"><i class="fa fa-times"></i></button>
                            </div>

                        </div>
                    @endif




                    <div class="form-group row col-1 add-detail-btn-wrapper" style="width: 100%;">
                        <button class="btn btn-primary btn-xs" id="addDetail"><i class="fa fa-plus"></i> </button>
                    </div>

                    <!-- <div class="item clearfix" id="income-0">
                                <div class="item__description">Salary</div>
                                <div class="right clearfix">
                                    <div class="item__value">+ 2,100.00</div>
                                    <div class="item__delete">
                                        <button class="item__delete--btn"><i class="ion-ios-close-outline"></i></button>
                                    </div>
                                </div>
                            </div> -->


                    <div class="form-group row pt-4 js--submit">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
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
            let $stockDetail = $('.stock-detail').first().clone(true); // if you want to clone events also, add true in clone(true)
            // $stockDetail.find('label').remove();
            $stockDetail.find('input').val('');
            $('.stock-detail').last().after($stockDetail);
            console.log(stockDetail);
        });
        $('#removeDetail').click(function (e) {
            e.preventDefault();
            console.log("here");
            let $details = $('.stock-detail');
            if($details.length > 1){
                $(this).closest('.stock-detail').remove();
            }else{
                alert("Can not delete first")
            }
        })
    </script>
@stop
