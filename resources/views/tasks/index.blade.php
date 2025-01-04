@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Task</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Task Name</th>
                <th>Job</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->task_name }}</td>
                <td>{{ $task->job->purchase_order_number }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ $task->completed ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
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