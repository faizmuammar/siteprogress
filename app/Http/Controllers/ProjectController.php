<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // READ + LARAVEL COLLECTION OPERATIONS
    public function index(Request $request)
    {
        // Mengambil seluruh data proyek via Eloquent (menghasilkan Illuminate\Database\Eloquent\Collection)
        $allProjects = Project::with(['owner', 'pic', 'attendances'])->latest()->get();

        // Implementasi Method Laravel Collection untuk Statistik & Filtering
        $stats = [
            'total_projects'    => $allProjects->count(),
            'average_progress'  => round($allProjects->avg('progress_percentage') ?? 0, 1),
            'on_track_count'    => $allProjects->where('status', 'On Track')->count(),
            'delayed_count'     => $allProjects->where('status', 'Delayed')->count(),
            'grouped_by_status' => $allProjects->groupBy('status'),
        ];

        // Filter interaktif menggunakan Collection filter() jika user memilih status
        $statusFilter = $request->query('status');
        $projects = $statusFilter
            ? $allProjects->filter(fn($item) => $item->status === $statusFilter)
            : $allProjects;

        // Data terhapus (Soft Deletes)
        $trashedProjects = Project::onlyTrashed()->get();

        return view('program.index', compact('projects', 'trashedProjects', 'stats', 'statusFilter'));
    }

    // CREATE (Form Processing & Validation)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'                   => 'required|string|max:30|unique:projects,code',
            'title'                  => 'required|string|min:5|max:255',
            'client_name'            => 'required|string|max:255',
            'location'               => 'required|string|max:255',
            'progress_percentage'    => 'required|numeric|min:0|max:100',
            'status'                 => 'required|in:On Track,Delayed,Final Stage',
            'start_date'             => 'required|date',
            'target_completion_date' => 'required|date|after_or_equal:start_date',
        ], [
            'code.required'                        => 'Kode proyek wajib diisi.',
            'code.unique'                          => 'Kode proyek sudah terdaftar, gunakan kode lain.',
            'title.min'                            => 'Nama proyek minimal 5 karakter.',
            'progress_percentage.max'              => 'Persentase progres maksimal 100%.',
            'target_completion_date.after_or_equal'=> 'Tanggal target selesai tidak boleh lebih awal dari tanggal mulai.',
        ]);

        $validated['owner_user_id'] = 2; // Default Klien dari Seeder
        $validated['pic_user_id']   = 1; // Default PIC dari Seeder

        Project::create($validated);

        return redirect()->route('program.index')->with('success', 'Proyek baru berhasil ditambahkan ke database!');
    }

    // FORM EDIT (Menampilkan halaman edit proyek)
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('program.edit', compact('project'));
    }

    // UPDATE (Form Processing & Validation)
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'code'                   => 'required|string|max:30|unique:projects,code,' . $project->id,
            'title'                  => 'required|string|min:5|max:255',
            'client_name'            => 'required|string|max:255',
            'location'               => 'required|string|max:255',
            'progress_percentage'    => 'required|numeric|min:0|max:100',
            'status'                 => 'required|in:On Track,Delayed,Final Stage',
            'start_date'             => 'required|date',
            'target_completion_date' => 'required|date|after_or_equal:start_date',
        ]);

        $project->update($validated);

        return redirect()->route('program.index')->with('success', 'Data proyek "' . $project->title . '" berhasil diperbarui!');
    }

    // DELETE (Soft Delete)
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('program.index')->with('success', 'Proyek diarsipkan (Soft Deleted). Anda dapat memulihkannya kapan saja.');
    }

    // RESTORE (Mengembalikan data Soft Delete)
    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('program.index')->with('success', 'Proyek berhasil dipulihkan kembali!');
    }
}