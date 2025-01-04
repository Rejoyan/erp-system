<?php

namespace App\Http\Controllers;

use App\Models\Report; // Import the Report model
use App\Models\Task; // Import the Task model
use App\Models\User; // Import the User model
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Generate a Task Report.
     * Fetch all tasks, including associated users, and save the report in the database.
     */
    public function generateTaskReport(Request $request)
    {
        $tasks = Task::with(['user'])->get(); // Eager load the 'user' relationship
        $reportData = $tasks->map(function ($task) {
            return [
                'Task ID' => $task->id,
                'Task Name' => $task->name,
                'Assigned To' => $task->user->name ?? 'Unassigned',
                'Status' => $task->status,
                'Created At' => $task->created_at->toDateTimeString(),
            ];
        });

        $report = Report::create([
            'report_type' => 'task',
            'data' => json_encode($reportData), // Store as JSON
        ]);

        return redirect()->route('reports.index')->with('success', 'Task report generated successfully.');
    }

    /**
     * Generate a User Report.
     * Fetch all users and save the report in the database.
     */
    public function generateUserReport(Request $request)
    {
        $users = User::all();
        $reportData = $users->map(function ($user) {
            return [
                'User ID' => $user->id,
                'Name' => $user->name,
                'Email' => $user->email,
                'Role' => $user->role ?? 'N/A',
                'Created At' => $user->created_at->toDateTimeString(),
            ];
        });

        $report = Report::create([
            'report_type' => 'user',
            'data' => json_encode($reportData), // Store as JSON
        ]);

        return redirect()->route('reports.index')->with('success', 'User report generated successfully.');
    }

    /**
     * Display a specific report's data.
     */
    public function show($id)
    {
        $report = Report::findOrFail($id);

        $reportData = json_decode($report->data, true);

        return view('reports.show', [
            'report' => $report,
            'data' => $reportData,
        ]);
    }

    /**
     * List all reports with basic metadata.
     */
    public function index()
    {
        $reports = Report::latest()->paginate(10);

        return view('reports.index', compact('reports'));
    }
}
