<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FieldOpsController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Multi-Role
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Home (Eloquent Data)
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// CRUD Proyek & Soft Delete
Route::resource('projects', ProjectController::class);
Route::post('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');

// Operasional Lapangan (PIC & To-Do)
Route::post('/attendance/store', [FieldOpsController::class, 'storeAttendance'])->name('attendance.store');
Route::post('/daily-report/store', [FieldOpsController::class, 'storeDailyReport'])->name('report.store');
Route::patch('/todo/{id}/toggle', [FieldOpsController::class, 'toggleTodo'])->name('todo.toggle');
Route::delete('/todo/{id}', [FieldOpsController::class, 'deleteTodo'])->name('todo.destroy');