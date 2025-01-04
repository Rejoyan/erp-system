<?php

namespace App\Http\Controllers;

use App\Models\Job; // Import the Job model
use App\Models\AuditLog; // Import the AuditLog model
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Display a listing of the job cards with pagination
    public function index()
    {
        $jobs = Job::latest()->paginate(10); // Paginate jobs
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
        $validatedData = $request->validate([
            'po_number' => 'required|unique:jobs',
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'part_number' => 'required',
            'revision' => 'nullable|string',
            'description' => 'required',
            'units_required' => 'required|integer',
            'price_per_unit' => 'required|numeric',
            'job_number' => 'nullable|string',
            'cost_per_unit' => 'nullable|numeric',
            'stock_in_hand' => 'nullable|integer',
            'stock_location' => 'nullable|string',
            'job_status' => 'nullable|string',
        ]);

        // Assign default values
        $validatedData['job_number'] = $validatedData['job_number'] ?? uniqid('JOB-');
        $validatedData['job_status'] = $validatedData['job_status'] ?? 'Not Opened Yet';

        $job = Job::create($validatedData);

        // Log the action
        $this->logAction('create', Job::class, $job->id);

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
        $validatedData = $request->validate([
            'po_number' => 'required|unique:jobs,po_number,' . $job->id,
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'part_number' => 'required',
            'revision' => 'nullable|string',
            'description' => 'required',
            'units_required' => 'required|integer',
            'price_per_unit' => 'required|numeric',
            'job_number' => 'nullable|string',
            'cost_per_unit' => 'nullable|numeric',
            'stock_in_hand' => 'nullable|integer',
            'stock_location' => 'nullable|string',
            'job_status' => 'nullable|string',
        ]);

        $job->update($validatedData);

        // Log the action
        $this->logAction('update', Job::class, $job->id);

        return redirect()->route('jobs.index')->with('success', 'Job card updated successfully.');
    }

    // Remove the specified job card from storage
    public function destroy(Job $job)
    {
        $job->delete();

        // Log the action
        $this->logAction('delete', Job::class, $job->id);

        return redirect()->route('jobs.index')->with('success', 'Job card deleted successfully.');
    }

    // Log action method
    protected function logAction($action, $modelType, $modelId)
    {
        $log = new AuditLog();
        $log->user_id = auth()->id(); // Assuming user is authenticated
        $log->action = $action;
        $log->model_type = $modelType;
        $log->model_id = $modelId;
        $log->save();
    }
}
