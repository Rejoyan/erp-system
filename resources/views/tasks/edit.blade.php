@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="job_id">Job</label>
            <select name="job_id" class="form-control" required>
                <option value="">Select Job</option>
                @foreach ($jobs as $job)
                    <option value="{{ $job->id }}" {{ $job->id == $task->job_id ? 'selected' : '' }}>{{ $job->purchase_order_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="task_name">Task Name</label>
            <input type="text" name="task_name" class="form-control" value="{{ $task->task_name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
        </div>
        <div class="form-group">
            <label for="completed">Completed</label>
            <input type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection