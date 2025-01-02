@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Purchase Orders</h1>
    <a href="{{ route('purchase_orders.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Purchase Order</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Order Number</th>
                <th>Order Date</th>
                <th>Expected Delivery Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseOrders as $purchaseOrder)
            <tr>
                <td>{{ $purchaseOrder->order_number }}</td>
                <td>{{ $purchaseOrder->order_date }}</td>
                <td>{{ $purchaseOrder->expected_delivery_date }}</td>
                <td>
                    <a href="{{ route('purchase_orders.edit', $purchaseOrder) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('purchase_orders.destroy', $purchaseOrder) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection