@extends('layouts.app')

@section('title', 'Manajemen Proyek & CRUD - SiteProgress')

@section('content')
<div class="space-y-8">

    {{-- Header & Notifikasi Sukses --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-blue-400 uppercase tracking-wider">Portfolio & Site Control</span>
            <h1 class="text-3xl font-extrabold text-white mt-1">Manajemen Proyek Konstruksi</h1>
            <p class="text-slate-400 text-sm">Kelola data proyek PT Tiga Cipta Selaras (Create, Read, Update, Soft Delete)</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-950/90 border border-emerald-600 text-emerald-300 text-sm font-semibold flex items-center gap-2">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif

    {{-- 1. RINGKASAN STATISTIK DARI LARAVEL COLLECTION --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-slate-800/90 border border-slate-700 rounded-2xl p-4">
            <p class="text-xs text-slate-400">Total Proyek (Count)</p>
            <p class="text-2xl font-black text-white mt-1">{{ $stats['total_projects'] }} Proyek</p>
        </div>
        <div class="bg-slate-800/90 border border-slate-700 rounded-2xl p-4">
            <p class="text-xs text-slate-400">Rata-rata Progres (Avg)</p>
            <p class="text-2xl font-black text-blue-400 mt-1">{{ $stats['average_progress'] }}%</p>
        </div>
        <div class="bg-slate-800/90 border border-slate-700 rounded-2xl p-4">
            <p class="text-xs text-slate-400">Status On Track</p>
            <p class="text-2xl font-black text-emerald-400 mt-1">{{ $stats['on_track_count'] }} Situs</p>
        </div>
        <div class="bg-slate-800/90 border border-slate-700 rounded-2xl p-4">
            <p class="text-xs text-slate-400">Status Delayed</p>
            <p class="text-2xl font-black text-rose-400 mt-1">{{ $stats['delayed_count'] }} Situs</p>
        </div>
    </div>

    {{-- 2. FORM CREATE PROYEK BARU + FORM VALIDATION --}}
    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6">
        <h2 class="text-lg font-bold text-white mb-4">➕ Tambah Proyek Baru</h2>

        @if($errors->any())
            <div class="mb-4 p-4 rounded-xl bg-rose-950/80 border border-rose-700 text-rose-300 text-xs space-y-1">
                <p class="font-bold">Periksa kembali inputan form Anda:</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 text-xs">
            @csrf
            <div>
                <label class="text-slate-300 font-semibold block mb-1">Kode Proyek *</label>
                <input type="text" name="code" value="{{ old('code') }}" placeholder="Contoh: PRJ-TCS-004" class="w-full bg-slate-900 border @error('code') border-rose-500 @else border-slate-700 @enderror rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Nama Proyek *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Pembangunan Gudang B" class="w-full bg-slate-900 border @error('title') border-rose-500 @else border-slate-700 @enderror rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Nama Klien *</label>
                <input type="text" name="client_name" value="{{ old('client_name') }}" placeholder="PT Mitra Industri" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Lokasi *</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="Kawasan MM2100 Bekasi" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Progres (%) *</label>
                <input type="number" step="0.1" name="progress_percentage" value="{{ old('progress_percentage', 0) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Status *</label>
                <select name="status" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
                    <option value="On Track" {{ old('status') == 'On Track' ? 'selected' : '' }}>On Track</option>
                    <option value="Delayed" {{ old('status') == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                    <option value="Final Stage" {{ old('status') == 'Final Stage' ? 'selected' : '' }}>Final Stage</option>
                </select>
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Tanggal Mulai *</label>
                <input type="date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div>
                <label class="text-slate-300 font-semibold block mb-1">Target Selesai *</label>
                <input type="date" name="target_completion_date" value="{{ old('target_completion_date') }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white">
            </div>

            <div class="md:col-span-4 flex justify-end mt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-blue-600/20 transition-all">
                    Simpan Proyek Baru
                </button>
            </div>
        </form>
    </div>

    {{-- 3. TABEL DATA PROYEK AKTIF (READ, FILTER COLLECTION, UPDATE, DELETE) --}}
    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-lg font-bold text-white">📋 Daftar Proyek Aktif</h2>
            
            {{-- Tombol Filter berbasis Collection --}}
            <div class="flex items-center gap-2 text-xs">
                <a href="{{ route('program.index') }}" class="px-3 py-1.5 rounded-lg border {{ !$statusFilter ? 'bg-blue-600 text-white border-blue-500' : 'bg-slate-900 text-slate-300 border-slate-700' }}">Semua</a>
                <a href="{{ route('program.index', ['status' => 'On Track']) }}" class="px-3 py-1.5 rounded-lg border {{ $statusFilter == 'On Track' ? 'bg-emerald-600 text-white border-emerald-500' : 'bg-slate-900 text-slate-300 border-slate-700' }}">On Track</a>
                <a href="{{ route('program.index', ['status' => 'Delayed']) }}" class="px-3 py-1.5 rounded-lg border {{ $statusFilter == 'Delayed' ? 'bg-rose-600 text-white border-rose-500' : 'bg-slate-900 text-slate-300 border-slate-700' }}">Delayed</a>
                <a href="{{ route('program.index', ['status' => 'Final Stage']) }}" class="px-3 py-1.5 rounded-lg border {{ $statusFilter == 'Final Stage' ? 'bg-indigo-600 text-white border-indigo-500' : 'bg-slate-900 text-slate-300 border-slate-700' }}">Final Stage</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-slate-700 text-slate-400 uppercase">
                        <th class="py-3 px-4">Kode</th>
                        <th class="py-3 px-4">Proyek & Lokasi</th>
                        <th class="py-3 px-4">Klien</th>
                        <th class="py-3 px-4">Progres</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Aksi (CRUD)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/60">
                    @forelse($projects as $project)
                        <tr class="hover:bg-slate-900/50 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-blue-400">{{ $project->code }}</td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $project->title }}</p>
                                <p class="text-slate-400 text-[11px]">📍 {{ $project->location }}</p>
                            </td>
                            <td class="py-3.5 px-4 text-slate-300">{{ $project->client_name }}</td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-20 bg-slate-900 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $project->progress_percentage }}%"></div>
                                    </div>
                                    <span class="font-bold text-white">{{ $project->progress_percentage }}%</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full font-semibold text-[11px]
                                    {{ $project->status == 'On Track' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : ($project->status == 'Delayed' ? 'bg-rose-950 text-rose-400 border border-rose-800' : 'bg-blue-950 text-blue-400 border border-blue-800') }}">
                                    {{ $project->status }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-2">
                                <a href="{{ route('projects.edit', $project->id) }}" class="inline-block bg-amber-600/20 hover:bg-amber-600 text-amber-400 hover:text-white border border-amber-600/50 px-3 py-1.5 rounded-lg font-semibold transition-all">
                                    Edit
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Arsipkan proyek ini (Soft Delete)?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-600/20 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-600/50 px-3 py-1.5 rounded-lg font-semibold transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">Tidak ada data proyek yang sesuai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 4. ARSIP PROYEK TERHAPUS (SOFT DELETED RESTORE) --}}
    @if($trashedProjects->count() > 0)
        <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-6 space-y-3">
            <h3 class="text-sm font-bold text-slate-300">🗄️ Arsip Proyek (Soft Deleted)</h3>
            <div class="space-y-2">
                @foreach($trashedProjects as $trashed)
                    <div class="flex items-center justify-between p-3 bg-slate-800/60 border border-slate-700/60 rounded-xl text-xs">
                        <div>
                            <span class="font-mono text-slate-400 mr-2">[{{ $trashed->code }}]</span>
                            <span class="text-slate-200 font-semibold">{{ $trashed->title }}</span>
                        </div>
                        <form action="{{ route('projects.restore', $trashed->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-1.5 rounded-lg font-bold transition-all">
                                Pulihkan (Restore)
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection