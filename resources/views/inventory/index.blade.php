@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Inventory List</h1>
    <a href="{{ route('inventory.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Item</a>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search Bar -->
    <form class="d-flex mb-4" action="{{ route('inventory.index') }}" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search inventory..." aria-label="Search" name="search" value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> Search</button>
    </form>

    <!-- Inventory Table -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Part Number</th>
                <th>Quantity</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
            <tr>
                <td>{{ $inventory->part_number }}</td>
                <td>{{ $inventory->quantity }}</td>
                <td>{{ $inventory->location }}</td>
                <td>
                    <a href="{{ route('inventory.edit', $inventory) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('inventory.destroy', $inventory) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $inventories->links() }}
    </div>
</div>
@endsection
