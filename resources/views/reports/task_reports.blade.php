@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Task Reports</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Task Name</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection