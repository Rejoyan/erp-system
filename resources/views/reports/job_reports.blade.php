@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Job Reports</h1>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Job Number</th>
                <th>Purchase Order Number</th>
                <th>Order Date</th>
                <th>Expected Delivery Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
            <tr>
                <td>{{ $job->job_number }}</td>
                <td>{{ $job->purchase_order_number }}</td>
                <td>{{ $job->order_date }}</td>
                <td>{{ $job->expected_delivery_date }}</td>
                <td>{{ $job->job_status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection