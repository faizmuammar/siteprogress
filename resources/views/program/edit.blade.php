@extends('layouts.app')

@section('title', 'Edit Proyek - SiteProgress')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Update Data Proyek</span>
            <h1 class="text-2xl font-extrabold text-white mt-1">Edit: {{ $project->title }}</h1>
        </div>
        <a href="{{ route('program.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Kembali ke Daftar</a>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-xl bg-rose-950/80 border border-rose-700 text-rose-300 text-xs space-y-1">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6">
        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
            @csrf
            @method('PUT')

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Kode Proyek *</label>
                <input type="text" name="code" value="{{ old('code', $project->code) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Nama Proyek *</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Nama Klien *</label>
                <input type="text" name="client_name" value="{{ old('client_name', $project->client_name) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Lokasi *</label>
                <input type="text" name="location" value="{{ old('location', $project->location) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Capaian Progres (%) *</label>
                <input type="number" step="0.1" name="progress_percentage" value="{{ old('progress_percentage', $project->progress_percentage) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Status Proyek *</label>
                <select name="status" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
                    <option value="On Track" {{ old('status', $project->status) == 'On Track' ? 'selected' : '' }}>On Track</option>
                    <option value="Delayed" {{ old('status', $project->status) == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                    <option value="Final Stage" {{ old('status', $project->status) == 'Final Stage' ? 'selected' : '' }}>Final Stage</option>
                </select>
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Tanggal Mulai *</label>
                <input type="date" name="start_date" value="{{ old('start_date', $project->start_date) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Target Selesai *</label>
                <input type="date" name="target_completion_date" value="{{ old('target_completion_date', $project->target_completion_date) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div class="md:col-span-2 flex justify-end gap-3 mt-4 pt-4 border-t border-slate-700">
                <a href="{{ route('program.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-700 text-slate-200 font-semibold">Batal</a>
                <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white font-bold px-6 py-2.5 rounded-xl transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection