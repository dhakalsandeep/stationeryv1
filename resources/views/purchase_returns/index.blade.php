@extends('layouts.admin')
@section('page_header')
Purchases
@stop
{{--@section('content')--}}
{{--<div class="container-fluid m-2">--}}
{{--    <a type="button" href="{{route('purchase.create')}}" class="btn btn-primary" style="float:right; margin-bottom: 10px; color: #fff">Add New Purchase</a>--}}
@section('content')
{{--    @can('purchase_create')--}}
{{--        <div style="margin-bottom: 10px;" class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <a class="btn btn-success" href="{{ route("purchase.create") }}">--}}
{{--                    {{ trans('global.add') }} {{ trans('global.purchase.title_singular') }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endcan--}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th class="text-center">Supplier</th>
                            <th class="text-center">Bill No</th>
                            <th class="text-center">S Billdate</th>
                            <th class="text-center">P No</th>
                            <th class="text-center">R Date</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Discount</th>
{{--                            <th class="text-center">VAT</th>--}}
                            <th class="text-center">Grand Total</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase_returns as $purchase_return)
                        <tr>
                            <td class="text-left">{{$purchase_return->purchase_master->supplier->name}}</td>
                            <td class="text-left">{{$purchase_return->purchase_master->supplier_bill_no}}</td>
                            <td class="text-center">{{$purchase_return->purchase_master->supplier_bill_date}}</td>
                            <td class="text-center">{{$purchase_return->return_no}}</td>
                            <td class="text-center">{{$purchase_return->return_date}}</td>
                            <td class="text-right">{{$purchase_return->amount}}</td>
                            <td class="text-right">{{$purchase_return->discount}}</td>
{{--                            <td class="text-right">{{$purchase_return->vat}}</td>--}}
                            <td class="text-right">{{$purchase_return->total_amount}}</td>
                            <td style="display: flex;justify-content: space-evenly;"><a type="button" href="#" class="btn btn-xs btn-info"><i class="fas fa-undo"></i> Return</a>
                                <a type="button" href="#" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i> Cancel</a>
                                <a type="button" href="{{route('purchase.print',$purchase_return->id)}}"
                                   class="btn btn-xs btn-primary"><i class="fas fa-pen-square"></i> Print</a>
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
            $('.datatable:not(.ajaxTable)').DataTable();
        })
    </script>
@endsection
@endsection
