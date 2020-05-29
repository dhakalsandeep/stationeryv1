@extends('layouts.admin')
@section('page_header')
Purchases
@stop
{{--@section('content')--}}
{{--<div class="container-fluid m-2">--}}
{{--    <a type="button" href="{{route('purchase.create')}}" class="btn btn-primary" style="float:right; margin-bottom: 10px; color: #fff">Add New Purchase</a>--}}
@section('content')
    @can('purchase_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("purchase.create") }}">
                    {{ trans('global.add') }} {{ trans('global.purchase.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th ></th>
                            <th class="text-center" width="22%">Supplier</th>
                            <th class="text-center" width="8%">Bill No</th>
                            <th class="text-center" width="8%">S Billdate</th>
                            <th class="text-center" width="8%">P No</th>
                            <th class="text-center" width="8%">R Date</th>
                            <th class="text-center" width="8%">Amount</th>
                            <th class="text-center" width="8%">Discount</th>
                            <th class="text-center" width="8%">VAT</th>
                            <th class="text-center" width="8%">Grand Total</th>
                            <th class="text-center" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td></td>
                            <td>{{$purchase->supplier->name}}</td>
                            <td>{{$purchase->supplier_bill_no}}</td>
                            <td>{{$purchase->supplier_bill_date}}</td>
                            <td>{{$purchase->purchase_no}}</td>
                            <td>{{$purchase->received_date}}</td>
                            <td>{{$purchase->amount}}</td>
                            <td>{{$purchase->discount}}</td>
                            <td>{{$purchase->vat}}</td>
                            <td>{{$purchase->total_amount}}</td>
                            <td><a type="button" href="#" class="btn btn-xs btn-primary"><i class="fas fa-pen-square"></i>Edit</a>
                                <a type="button" href="#" class="btn btn-xs btn-danger"><i class="fas fa-pen-square"></i> Delete</a>
                                <a type="button" href="{{route('purchase.print',$purchase->id)}}"
                                   class="btn btn-xs btn-primary"><i class="fas fa-pen-square"></i>Print</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section("scripts")
    <script>
        $(function () {
            let dtButtons = [];
            $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons });
            $('.select-checkbox').css('display','none');
        })
    </script>
@endsection
@endsection
