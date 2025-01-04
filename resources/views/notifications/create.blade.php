@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Add New Notification</h1>

    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" class="form-control" required>
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Notification</button>
    </form>
</div>
@endsection