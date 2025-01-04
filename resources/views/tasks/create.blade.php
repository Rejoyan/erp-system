@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Add New Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="job_id">Job</label>
            <select name="job_id" class="form-control" required>
                <option value="">Select Job</option>
                @foreach ($jobs as $job)
                    <option value="{{ $job->id }}">{{ $job->purchase_order_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="task_name">Task Name</label>
            <input type="text" name="task_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="completed">Completed</label>
            <input type="checkbox" name="completed" value="1">
        </div>
        <button type="submit" class="btn btn-success">Add Task</button>
    </form>
</div>
@endsection