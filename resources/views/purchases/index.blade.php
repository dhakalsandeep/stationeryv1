@extends('layouts.app2')
@section('page_header')
Purchases
@stop
@section('content')
<div class="container-fluid m-2">
    <a type="button" href="{{route('purchase.create')}}" class="btn btn-primary" style="float:right; margin-bottom: 10px; color: #fff">Add New Purchase</a>
    <table id="puchase--list" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center" width="40%">Supplier</th>
                <th class="text-center" width="5%">Bill No</th>
                <th class="text-center" width="5%">Supplier Billdate</th>
                <th class="text-center" width="5%">Purchased No</th>
                <th class="text-center" width="5%">Received Date</th>
                <th class="text-center" width="5%">Amount</th>
                <th class="text-center" width="5%">Discount</th>
                <th class="text-center" width="5%">VAT</th>
                <th class="text-center" width="5%">Grand Total</th>
                <th class="text-center" width="5%">Purchase No</th>
                <th class="text-center" width="15%">Action</th>
            </tr>
        </thead>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{$purchase->supplier->name}}</td>
                <td>{{$purchase->supplier_bill_no}}</td>
                <td>{{$purchase->supplier_bill_date}}</td>
                <td>{{$purchase->purchase_no}}</td>
                <td>{{$purchase->received_date}}</td>
                <td>{{$purchase->amount}}</td>
                <td>{{$purchase->discount}}</td>
                <td>{{$purchase->vat}}</td>
                <td>{{$purchase->total_amount}}</td>
                <td>{{$purchase->purchase_no}}</td>
                <td><a type="button" href="#" class="btn btn-xs btn-primary"><i class="fas fa-pen-square"></i>Edit</a>
                    <a type="button" href="#" class="btn btn-xs btn-danger"><i class="fas fa-pen-square"></i> Delete</a>
                    <a type="button" href="{{route('purchase.print',$purchase->id)}}"
                       class="btn btn-xs btn-primary"><i class="fas fa-pen-square"></i>Print</a>
                </td>
            </tr>
        @endforeach
    </table>

</div>
@endsection

@section("script")
    <script>
        $(function () {
            $("#puchase--list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@stop
