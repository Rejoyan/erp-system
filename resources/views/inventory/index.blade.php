@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Inventory List</h1>
    <a href="{{ route('inventory.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Item</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                    <a href="{{ route('inventory.edit', $inventory) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('inventory.destroy', $inventory) }}" method="POST" style="display:inline;">
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