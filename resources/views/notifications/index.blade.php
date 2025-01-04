@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Notifications</h1>
    <a href="{{ route('notifications.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Notification</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>User</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
            <tr>
                <td>{{ $notification->user->name }}</td>
                <td>{{ $notification->message }}</td>
                <td>{{ $notification->is_read ? 'Read' : 'Unread' }}</td>
                <td>
                    <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-info">Mark as Read</button>
                    </form>
                    <form action="{{ route('notifications.destroy', $notification) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection