@extends('layouts.app')

@section('title', 'Home - SiteProgress Assessment 1')

@section('content')
<div class="space-y-8">
    {{-- Banner Utama --}}
    <div class="bg-gradient-to-r from-blue-900/40 to-slate-800 border border-blue-500/30 rounded-2xl p-8 md:p-10 shadow-2xl">
        <span class="text-blue-400 text-xs font-bold uppercase tracking-widest bg-blue-950/80 px-3 py-1 rounded-full border border-blue-700/50">
            Building Space, Creating Value
        </span>
        <h1 class="text-4xl font-extrabold text-white mt-4 mb-3">SiteProgress Enterprise System</h1>
        <p class="text-slate-300 text-base md:text-lg max-w-3xl leading-relaxed mb-6">
            Sistem pemantauan progres fisik, logistik material, dan kehadiran tenaga kerja harian pada proyek pembangunan pabrik & pergudangan skala besar.
        </p>

        {{-- Blade Directive Check / Short Command --}}
        @php
            $systemStatus = 'Operational';
            $activeModuleCount = 4;
        @endphp

        <div class="flex flex-wrap items-center gap-4 pt-2 border-t border-slate-700/60">
            <span class="text-sm text-slate-400">Status Sistem:</span>
            @if($systemStatus === 'Operational')
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-950/80 text-emerald-400 border border-emerald-800/50">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> {{ $systemStatus }}
                </span>
            @else
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-950 text-amber-400 border border-amber-800">
                    Maintenance
                </span>
            @endif
            <span class="text-sm text-slate-400">• Total Modul Aktif: <strong class="text-white">{{ $activeModuleCount }}</strong></span>
        </div>
    </div>

    {{-- Modul Ringkasan Fitur Utama --}}
    <div>
        <h2 class="text-2xl font-bold text-white mb-4">Ringkasan Fitur & Modul Konstruksi</h2>
        @php
            $modules = [
                ['title' => 'Zonal Daily Progress Log', 'desc' => 'Pencatatan progres harian berbasis zona lokasi pabrik/gudang.', 'badge' => 'Core Module'],
                ['title' => 'Manpower & Equipment Tracker', 'desc' => 'Presensi harian tukang dan rekap jam kerja alat berat.', 'badge' => 'Field Ops'],
                ['title' => 'Geotagged Progress Gallery', 'desc' => 'Arsip foto dokumentasi visual proyek ber-koordinat.', 'badge' => 'Visual Log'],
                ['title' => 'Stakeholder Transparency Portal', 'desc' => 'Portal pemantauan kurva progres untuk investor/klien.', 'badge' => 'Reporting'],
            ];
        @endphp

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($modules as $module)
                <x-card :title="$module['title']" :badge="$module['badge']">
                    <p>{{ $module['desc'] }}</p>
                </x-card>
            @empty
                <p class="text-slate-400">Belum ada modul yang terdaftar.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection