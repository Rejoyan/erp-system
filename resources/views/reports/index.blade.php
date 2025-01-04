@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Reports</h1>

    <form action="{{ route('reports.generateJobReport') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Generate Job Report</button>
    </form>

    <h2 class="mt-4">Generated Reports</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Report Type</th>
                <th>Data</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->report_type }}</td>
                <td>{{ $report->data }}</td>
                <td>{{ $report->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection