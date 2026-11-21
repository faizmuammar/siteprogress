<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Attendance;
use App\Models\DailyReport;
use App\Models\TodoItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role', 'owner_proyek');

        // Mengambil data proyek beserta relasinya menggunakan Eloquent
        $projects = Project::with(['attendances', 'dailyReports', 'todoItems'])->get();
        $myProject = Project::with(['attendances', 'dailyReports', 'todoItems'])->first();
        
        $latestReports = DailyReport::with('project')->latest('report_date')->take(5)->get();
        $todayAttendance = Attendance::latest('attendance_date')->first();
        $todos = TodoItem::all();

        return view('home', compact(
            'role',
            'projects',
            'myProject',
            'latestReports',
            'todayAttendance',
            'todos'
        ));
    }
}