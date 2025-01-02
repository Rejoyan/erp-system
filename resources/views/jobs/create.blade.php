@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Add New Job Card</h1>

    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="purchase_order_number">Purchase Order Number</label>
            <input type="text" name="purchase_order_number" class="form-control" required>
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
            <label for="item_code">Item Code</label>
            <input type="text" name="item_code" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="revision_drawing">Revision Drawing</label>
            <input type="text" name="revision_drawing" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="quantity_required">Quantity Required</label>
            <input type="number" name="quantity_required" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="number" step="0.01" name="unit_price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="job_status">Status</label>
            <input type="text" name="job_status" class="form-control" value="Pending">
        </div>
        
        <button type="submit" class="btn btn-success">Add Job Card</button>
    </form>
</div>
@endsection