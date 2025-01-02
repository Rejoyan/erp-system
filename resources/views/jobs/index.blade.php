@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Job Cards</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Job Card</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Job Number</th>
                <th>Status</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
            <tr>
                <td>{{ $job->job_number }}</td>
                <td>{{ $job->job_status }}</td>
                <td>{{ $job->description }}</td>
                <td>
                    <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST" style="display:inline;">
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