@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">User Reports</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection