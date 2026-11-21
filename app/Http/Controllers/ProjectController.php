<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        $trashedProjects = Project::onlyTrashed()->get(); // Data yang di-soft delete

        return view('program.index', compact('projects', 'trashedProjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:projects,code',
            'title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'progress_percentage' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:On Track,Delayed,Final Stage',
            'start_date' => 'required|date',
            'target_completion_date' => 'required|date',
        ]);

        Project::create($validated);

        return redirect()->back()->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->back()->with('success', 'Data proyek diperbarui!');
    }

    // Soft Delete (data tidak hilang permanen, masuk ke kolom deleted_at)
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->back()->with('success', 'Proyek dipindahkan ke arsip (Soft Deleted)!');
    }

    // Mengembalikan data yang di-soft delete
    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->back()->with('success', 'Proyek berhasil dipulihkan!');
    }
}