@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Audit Logs</h1>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Model Type</th>
                <th>Model ID</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->user->name }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->model_type }}</td>
                <td>{{ $log->model_id }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection