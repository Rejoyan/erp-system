<?php

namespace App\Http\Controllers;

use App\Models\Job; // Import the Job model
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Display a listing of the job cards
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    // Show the form for creating a new job card
    public function create()
    {
        return view('jobs.create');
    }

    // Store a newly created job card in storage
    public function store(Request $request)
    {
        $request->validate([
            'purchase_order_number' => 'required|unique:jobs',
            'order_date' => 'required|date',
            'expected_delivery_date' => 'required|date',
            'item_code' => 'required',
            'revision_drawing' => 'nullable|string',
            'description' => 'required',
            'quantity_required' => 'required|integer',
            'unit_price' => 'required|numeric',
            'job_number' => 'nullable|string',
            'job_status' => 'nullable|string',
        ]);
    
        $data = $request->all();
        $data['job_number'] = $data['job_number'] ?? uniqid('JOB-');
        $data['job_status'] = $data['job_status'] ?? 'Pending';
    
        Job::create($data);
    
        return redirect()->route('jobs.index')->with('success', 'Job card created successfully.');
    }
    

    // Show the form for editing the specified job card
    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    // Update the specified job card in storage
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'purchase_order_number' => 'required|unique:jobs,purchase_order_number,' . $job->id,
            'order_date' => 'required|date',
            'expected_delivery_date' => 'required|date',
            'item_code' => 'required',
            'revision_drawing' => 'nullable|string',
            'description' => 'required',
            'quantity_required' => 'required|integer',
            'unit_price' => 'required|numeric',
            'job_number' => 'nullable|string',
            'job_status' => 'nullable|string',
        ]);
    
        $job->update($request->all());
    
        return redirect()->route('jobs.index')->with('success', 'Job card updated successfully.');
    }
    

    // Remove the specified job card from storage
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job card deleted successfully.');
    }
}
