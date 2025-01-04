@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Create Job Card</h1>
    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <!-- PO Number and Part Number -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="po_number">Purchase Order Number</label>
                <input type="text" name="po_number" class="form-control @error('po_number') is-invalid @enderror" value="{{ old('po_number') }}" required>
                @error('po_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="part_number">Part Number</label>
                <input type="text" name="part_number" class="form-control @error('part_number') is-invalid @enderror" value="{{ old('part_number') }}" required>
                @error('part_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Order Date and Delivery Date -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="order_date">Order Date</label>
                <input type="date" name="order_date" class="form-control @error('order_date') is-invalid @enderror" value="{{ old('order_date') }}" required>
                @error('order_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="delivery_date">Expected Delivery Date</label>
                <input type="date" name="delivery_date" class="form-control @error('delivery_date') is-invalid @enderror" value="{{ old('delivery_date') }}" required>
                @error('delivery_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Units Required, Price per Unit, Cost per Unit -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="units_required">Units Required</label>
                <input type="number" name="units_required" class="form-control @error('units_required') is-invalid @enderror" value="{{ old('units_required') }}" required>
                @error('units_required')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="price_per_unit">Price per Unit</label>
                <input type="number" step="0.01" name="price_per_unit" class="form-control @error('price_per_unit') is-invalid @enderror" value="{{ old('price_per_unit') }}" required>
                @error('price_per_unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="cost_per_unit">Cost per Unit</label>
                <input type="number" step="0.01" name="cost_per_unit" class="form-control @error('cost_per_unit') is-invalid @enderror" value="{{ old('cost_per_unit') }}">
                @error('cost_per_unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Revision, Job Number, Stock in Hand, and Stock Location -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="revision">Revision (if applicable)</label>
                <input type="text" name="revision" class="form-control @error('revision') is-invalid @enderror" value="{{ old('revision') }}">
                @error('revision')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="job_number">Job Number</label>
                <input type="text" name="job_number" class="form-control @error('job_number') is-invalid @enderror" value="{{ old('job_number') }}">
                @error('job_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Stock in Hand and Stock Location -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="stock_in_hand">Stock in Hand</label>
                <input type="number" name="stock_in_hand" class="form-control @error('stock_in_hand') is-invalid @enderror" value="{{ old('stock_in_hand') }}">
                @error('stock_in_hand')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="stock_location">Stock Location</label>
                <input type="text" name="stock_location" class="form-control @error('stock_location') is-invalid @enderror" value="{{ old('stock_location') }}">
                @error('stock_location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Job Status -->
        <div class="form-group">
            <label for="job_status">Job Status</label>
            <select name="job_status" class="form-control @error('job_status') is-invalid @enderror">
                <option value="Not Opened Yet">Not Opened Yet</option>
                <option value="In Process - Material Ordered">In Process - Material Ordered</option>
                <option value="In Process - Labour">In Process - Labour</option>
                <option value="In Process - External Process">In Process - External Process</option>
                <option value="Ready in Dispatch">Ready in Dispatch</option>
                <option value="Delivered">Delivered</option>
            </select>
            @error('job_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success btn-block">Create Job</button>
    </form>
</div>
@endsection
