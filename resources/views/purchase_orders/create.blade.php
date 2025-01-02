@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Add New Purchase Order</h1>

    <form action="{{ route('purchase_orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="order_number">Order Number</label>
            <input type="text" name="order_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="date" name="order_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="expected_delivery_date">Expected Delivery Date</label>
            <input type="date" name="expected_delivery_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="items">Items</label>
            <textarea name="items" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Purchase Order</button>
    </form>
</div>
@endsection