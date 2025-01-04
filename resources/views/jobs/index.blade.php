@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Job Cards Management</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Create New Job
    </a>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search Bar -->
    <form class="d-flex mb-4" action="{{ route('jobs.index') }}" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search jobs..." aria-label="Search" name="search" value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> Search</button>
    </form>

    <!-- Jobs Table -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Job Number</th>
                <th>PO Number</th>
                <th>Part Number</th>
                <th>Status</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jobs as $job)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $job->job_number }}</td>
                <td>{{ $job->po_number }}</td>
                <td>{{ $job->part_number }}</td>
                <td>
                    <span class="badge badge-{{ $job->job_status === 'Delivered' ? 'success' : ($job->job_status === 'Pending' ? 'warning' : 'danger') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $job->job_status }}">
                        {{ $job->job_status }}
                    </span>
                </td>
                <td>{{ Str::limit($job->description, 50, '...') }}</td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <!-- Delete Button -->
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this job?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No jobs available.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
