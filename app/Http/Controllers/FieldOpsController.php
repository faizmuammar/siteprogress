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
        $validated = $request->validate([
            'carpenter_mason_count'          => 'required|integer|min:0|max:500',
            'welder_ironworker_count'        => 'required|integer|min:0|max:500',
            'heavy_equipment_operator_count' => 'required|integer|min:0|max:100',
        ]);

        $total = $validated['carpenter_mason_count']
               + $validated['welder_ironworker_count']
               + $validated['heavy_equipment_operator_count'];

        Attendance::create([
            'project_id'                     => $request->input('project_id', 1),
            'attendance_date'                => now()->toDateString(),
            'carpenter_mason_count'          => $validated['carpenter_mason_count'],
            'welder_ironworker_count'        => $validated['welder_ironworker_count'],
            'heavy_equipment_operator_count' => $validated['heavy_equipment_operator_count'],
            'total_workers_present'          => $total,
        ]);

        return redirect()->back()->with('success', 'Presensi pekerja hari ini berhasil disimpan (' . $total . ' orang)!');
    }

    public function storeDailyReport(Request $request)
    {
        $validated = $request->validate([
            'notes'           => 'required|string|min:10|max:1000',
            'geotagged_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'notes.min'             => 'Catatan progres harian minimal 10 karakter.',
            'geotagged_photo.image' => 'File bukti harus berupa gambar (JPG/PNG).',
            'geotagged_photo.max'   => 'Ukuran foto maksimal 2MB.',
        ]);

        $photoPath = null;
        if ($request->hasFile('geotagged_photo')) {
            $photoPath = $request->file('geotagged_photo')->store('reports', 'public');
        }

        DailyReport::create([
            'project_id'           => $request->input('project_id', 1),
            'pic_user_id'          => $request->input('pic_user_id', 1),
            'report_date'          => now()->toDateString(),
            'notes'                => $validated['notes'],
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
        $todo->delete();

        return redirect()->back()->with('success', 'Task diarsipkan (Soft Delete)!');
    }
}