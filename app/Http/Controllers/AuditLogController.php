<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    // Display a listing of the audit logs
    public function index()
    {
        $logs = AuditLog::with('user')->get(); // Eager load user relationship
        return view('audit_logs.index', compact('logs'));
    }

    // Store a new audit log entry
    public function store($action, $modelType, $modelId)
    {
        $log = new AuditLog();
        $log->user_id = auth()->id(); // Assuming user is authenticated
        $log->action = $action;
        $log->model_type = $modelType;
        $log->model_id = $modelId;
        $log->save();
    }

    // Method to log actions (can be called from other controllers)
    public function logAction($action, $modelType, $modelId)
    {
        $this->store($action, $modelType, $modelId);
    }
}