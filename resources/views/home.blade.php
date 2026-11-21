@extends('layouts.app')

@section('title', 'Home Dashboard - SiteProgress')

@section('content')
@php
    $role = session('user_role', 'owner_proyek');
@endphp

<div class="space-y-8">

    {{-- SWITCH ROLE BANNER DEMO --}}
    <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-4 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <span class="text-xs text-slate-400 font-medium">Aktor Aktif:</span>
            @if($role == 'owner_proyek')
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-950 text-blue-400 border border-blue-800">👤 Owner Proyek (Klien)</span>
            @elseif($role == 'owner_tcs')
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-950 text-purple-400 border border-purple-800">🏢 Pemilik PT TCS (Executive)</span>
            @else
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-950 text-amber-400 border border-amber-800">👷‍♂️ PIC / Site Supervisor</span>
            @endif
        </div>
        <a href="{{ route('logout') }}" class="text-xs text-rose-400 hover:text-rose-300 font-semibold transition-colors">
            Ganti Aktor / Logout
        </a>
    </div>

    {{-- ========================================================================= --}}
    {{-- VIEW 1: OWNER PROYEK (KLIEN) --}}
    {{-- ========================================================================= --}}
    @if($role == 'owner_proyek')
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-blue-950/80 border border-slate-700/80 rounded-3xl p-6 md:p-8 shadow-xl">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div>
                    <span class="text-xs font-bold text-blue-400 uppercase tracking-wider">Proyek Anda</span>
                    <h1 class="text-3xl font-extrabold text-white mt-1">{{ $myProject->title ?? 'Pembangunan Pabrik Manufaktur Zonal A' }}</h1>
                    <p class="text-xs text-slate-400 mt-1">📍 {{ $myProject->location ?? 'Kawasan Industri Cikarang' }} | Kontraktor: PT Tiga Cipta Selaras</p>
                </div>
                <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-950 text-emerald-400 border border-emerald-800">
                    ● {{ $myProject->status ?? 'Dalam Pengerjaan' }}
                </span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-slate-700/60">
                <div class="bg-slate-900/80 border border-slate-700/50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 mb-1">Capaian Progres</p>
                    <p class="text-2xl font-black text-blue-400">{{ $myProject->progress_percentage ?? '82.5' }}%</p>
                    <p class="text-[11px] text-emerald-400 font-semibold mt-1">+2.1% minggu ini</p>
                </div>
                <div class="bg-slate-900/80 border border-slate-700/50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 mb-1">Pekerja Hadir Hari Ini</p>
                    <p class="text-2xl font-black text-emerald-400">{{ $todayAttendance->total_workers_present ?? 48 }} / 50</p>
                    <p class="text-[11px] text-slate-400 mt-1">Presensi Terverifikasi</p>
                </div>
                <div class="bg-slate-900/80 border border-slate-700/50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 mb-1">Target Selesai</p>
                    <p class="text-2xl font-black text-amber-400">{{ $myProject->target_completion_date ?? '15 Des 2026' }}</p>
                    <p class="text-[11px] text-slate-400 mt-1">Sesuai Schedule</p>
                </div>
                <div class="bg-slate-900/80 border border-slate-700/50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 mb-1">Laporan Terakhir</p>
                    <p class="text-2xl font-black text-indigo-400">Hari Ini</p>
                    <p class="text-[11px] text-slate-400 mt-1">Pengecoran Zona 2</p>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            {{-- Update Pembangunan Hari Ini --}}
            <div class="md:col-span-2 bg-slate-800 border border-slate-700 rounded-2xl p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white">Update Pembangunan Hari Ini</h3>
                    <span class="text-xs text-slate-400">{{ date('d M Y') }}</span>
                </div>
                <div class="space-y-3">
                    @forelse($latestReports as $report)
                        <div class="p-4 bg-slate-900/80 rounded-xl border border-slate-700/60 flex items-start gap-4">
                            <span class="text-2xl">🏗️</span>
                            <div>
                                <h4 class="font-bold text-white text-sm">Laporan Tanggal {{ $report->report_date }}</h4>
                                <p class="text-xs text-slate-400 mt-1">{{ $report->notes }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 bg-slate-900/80 rounded-xl border border-slate-700/60 flex items-start gap-4">
                            <span class="text-2xl">🏗️</span>
                            <div>
                                <h4 class="font-bold text-white text-sm">Pengecoran Struktur Beton Zona A2</h4>
                                <p class="text-xs text-slate-400 mt-1">Tim lapangan telah menyelesaikan volume 120m³ cor beton ready-mix. Pengeringan diperkirakan 48 jam.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- To Do List & Milestone --}}
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 space-y-4">
                <h3 class="text-lg font-bold text-white">To-Do & Milestone Proyek</h3>
                <div class="space-y-3 text-xs">
                    @forelse($todos as $todo)
                        <div class="flex items-center justify-between p-3 bg-slate-900 rounded-xl border border-slate-700">
                            <span class="{{ $todo->is_completed ? 'line-through text-slate-500' : 'text-white font-semibold' }}">
                                {{ $todo->task_name }}
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded {{ $todo->is_completed ? 'bg-emerald-950 text-emerald-400' : 'bg-blue-950 text-blue-400' }}">
                                {{ $todo->is_completed ? 'Selesai' : 'Proses' }}
                            </span>
                        </div>
                    @empty
                        <div class="p-3 bg-slate-900 rounded-xl border border-slate-700 text-slate-400">
                            Pemasangan Atap ZincAlum (Sedang Berjalan)
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    {{-- ========================================================================= --}}
    {{-- VIEW 2: PEMILIK TIGA CIPTA SELARAS (EXECUTIVE VIEW) --}}
    {{-- ========================================================================= --}}
    @elseif($role == 'owner_tcs')
        <div class="space-y-6">
            <div>
                <h1 class="text-3xl font-extrabold text-white">Executive Control Dashboard</h1>
                <p class="text-slate-400 text-sm">Ringkasan seluruh situs proyek aktif PT Tiga Cipta Selaras</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @forelse($projects as $proj)
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-bold text-blue-400 bg-blue-950 px-2.5 py-1 rounded">{{ $proj->code }}</span>
                            <span class="text-xs bg-emerald-950 text-emerald-400 px-2 py-0.5 rounded-full border border-emerald-800">{{ $proj->status }}</span>
                        </div>
                        <h3 class="text-base font-bold text-white mb-1">{{ $proj->title }}</h3>
                        <p class="text-xs text-slate-400 mb-4">Klien: {{ $proj->client_name }}</p>
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="text-slate-400">Progres:</span>
                                <span class="text-blue-400 font-bold">{{ $proj->progress_percentage }}%</span>
                            </div>
                            <div class="w-full bg-slate-900 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $proj->progress_percentage }}%"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-slate-800 border border-slate-700 rounded-2xl p-6 text-center text-slate-400 text-sm">
                        Belum ada data proyek di database. Silakan tambahkan data proyek melalui menu Program.
                    </div>
                @endforelse
            </div>
        </div>

    {{-- ========================================================================= --}}
    {{-- VIEW 3: PIC LAPANGAN / SITE SUPERVISOR --}}
    {{-- ========================================================================= --}}
    @else
        <div class="space-y-6">
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-950 border border-emerald-700 text-emerald-300 text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <h1 class="text-3xl font-extrabold text-white">Portal Input Lapangan (PIC)</h1>
                <p class="text-slate-400 text-sm">Site: {{ $myProject->title ?? 'Pabrik Manufaktur Zonal A' }}</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                {{-- Form Presensi Tukang --}}
                <form action="{{ route('attendance.store') }}" method="POST" class="bg-slate-800 border border-slate-700 rounded-2xl p-6 space-y-4">
                    @csrf
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>👷‍♂️</span> Presensi Pekerja Hari Ini
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-xs text-slate-300">
                            <span>Tukang Kayu/Batu:</span>
                            <input type="number" name="carpenter_mason_count" value="20" class="w-20 bg-slate-900 border border-slate-700 rounded p-1.5 text-right text-white">
                        </div>
                        <div class="flex justify-between items-center text-xs text-slate-300">
                            <span>Tukang Besi/Las:</span>
                            <input type="number" name="welder_ironworker_count" value="15" class="w-20 bg-slate-900 border border-slate-700 rounded p-1.5 text-right text-white">
                        </div>
                        <div class="flex justify-between items-center text-xs text-slate-300">
                            <span>Operator Alat Berat:</span>
                            <input type="number" name="heavy_equipment_operator_count" value="5" class="w-20 bg-slate-900 border border-slate-700 rounded p-1.5 text-right text-white">
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-2.5 rounded-xl text-xs transition-all">
                            Simpan Presensi ke Database
                        </button>
                    </div>
                </form>

                {{-- Form Upload Dokumen & Foto Lapangan --}}
                <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-800 border border-slate-700 rounded-2xl p-6 space-y-4">
                    @csrf
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>📸</span> Upload Laporan & Foto Lapangan
                    </h3>
                    <div class="space-y-3 text-xs">
                        <div>
                            <label class="text-slate-400 block mb-1">Catatan Progress Harian</label>
                            <textarea name="notes" required class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white" rows="2" placeholder="Tuliskan pengerjaan hari ini..."></textarea>
                        </div>
                        <div>
                            <label class="text-slate-400 block mb-1">Foto Bukti Lapangan (Geotagged)</label>
                            <input type="file" name="geotagged_photo" class="w-full text-slate-400 bg-slate-900 border border-slate-700 rounded-xl p-2">
                        </div>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 rounded-xl text-xs transition-all">
                            Kirim Laporan ke Database
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>
@endsection