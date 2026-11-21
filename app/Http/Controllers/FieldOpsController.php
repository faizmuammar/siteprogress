<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DailyReport;
use App\Models\TodoItem;
use Illuminate\Http\Request;

class FieldOpsController extends Controller
{
    public function storeAttendance(Request $request)
    {
        $total = $request->carpenter_mason_count + $request->welder_ironworker_count + $request->heavy_equipment_operator_count;

        Attendance::create([
            'project_id' => $request->project_id ?? 1,
            'attendance_date' => now()->toDateString(),
            'carpenter_mason_count' => $request->carpenter_mason_count ?? 0,
            'welder_ironworker_count' => $request->welder_ironworker_count ?? 0,
            'heavy_equipment_operator_count' => $request->heavy_equipment_operator_count ?? 0,
            'total_workers_present' => $total,
        ]);

        return redirect()->back()->with('success', 'Presensi pekerja hari ini berhasil disimpan!');
    }

    public function storeDailyReport(Request $request)
    {
        $photoPath = null;
        if ($request->hasFile('geotagged_photo')) {
            $photoPath = $request->file('geotagged_photo')->store('reports', 'public');
        }

        DailyReport::create([
            'project_id' => $request->project_id ?? 1,
            'pic_user_id' => $request->pic_user_id ?? 1,
            'report_date' => now()->toDateString(),
            'notes' => $request->notes,
            'geotagged_photo_path' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'Laporan harian lapangan berhasil dikirim!');
    }

    public function toggleTodo($id)
    {
        $todo = TodoItem::findOrFail($id);
        $todo->update(['is_completed' => !$todo->is_completed]);

        return redirect()->back()->with('success', 'Status milestone diperbarui!');
    }

    public function deleteTodo($id)
    {
        $todo = TodoItem::findOrFail($id);
        $todo->delete(); // Menggunakan Soft Delete

        return redirect()->back()->with('success', 'Task dihapus sementara (Soft Delete)!');
    }
}