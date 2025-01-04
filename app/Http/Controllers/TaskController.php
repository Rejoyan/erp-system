<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Job;
use App\Models\AuditLog; // Import the AuditLog model
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display a listing of the tasks
    public function index()
    {
        $tasks = Task::with('job')->get(); // Eager load job relationship
        return view('tasks.index', compact('tasks'));
    }

    // Show the form for creating a new task
    public function create()
    {
        $jobs = Job::all(); // Get all jobs for the dropdown
        return view('tasks.create', compact('jobs'));
    }

    // Store a newly created task in storage
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'task_name' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'completed' => 'boolean',
        ]);

        $task = Task::create($request->all());

        // Log the action
        $this->logAction('create', Task::class, $task->id);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show the form for editing the specified task
    public function edit(Task $task)
    {
        $jobs = Job::all(); // Get all jobs for the dropdown
        return view('tasks.edit', compact('task', 'jobs'));
    }

    // Update the specified task in storage
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'task_name' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'completed' => 'boolean',
        ]);

        $task->update($request->all());

        // Log the action
        $this->logAction('update', Task::class, $task->id);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Remove the specified task from storage
    public function destroy(Task $task)
    {
        $task->delete();

        // Log the action
        $this->logAction('delete', Task::class, $task->id);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
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