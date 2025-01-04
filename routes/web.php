<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuditLogController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/      

Route::get('/', function () {
    return view('welcome');
});




Route::get('/home', function () {
    return view('home'); 
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

Route::post('reports/generate-job-report', [ReportController::class, 'generateJobReport'])->name('reports.generateJobReport');

Route::resource('purchase_orders', PurchaseOrderController::class);

Route::resource('inventory', InventoryController::class);

Route::resource('jobs', JobController::class);  

Route::resource('tasks', TaskController::class);

Route::resource('users', UserController::class);

Route::resource('notifications', NotificationController::class);


Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');

Route::post('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('reports/jobs', [ReportController::class, 'jobReports'])->name('reports.jobs');
Route::get('reports/tasks', [ReportController::class, 'taskReports'])->name('reports.tasks');
Route::get('reports/users', [ReportController::class, 'userReports'])->name('reports.users');

// Auth routes  
require __DIR__.'/auth.php';