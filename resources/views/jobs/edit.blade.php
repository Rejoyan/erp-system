@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Job Card</h1>

    <form action="{{ route('jobs.update', $job) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="job_number">Job Number</label>
            <input type="text" name="job_number" class="form-control" value="{{ $job->job_number }}" required>
        </div>
        <div class="form-group">
            <label for="job_status">Status</label>
            <input type="text" name="job_status" class="form-control" value="{{ $job->job_status }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $job->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Job Card</button>
    </form>
</div>
@endsection