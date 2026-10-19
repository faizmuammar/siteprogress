@extends('layouts.app')

@section('title', 'Dashboard Monitoring Proyek - SiteProgress')

@section('content')
<div class="space-y-10">

    {{-- 1. HERO BANNER DENGAN VISUAL GAMBAR PROYEK (OPSI C) & COLOR GRADIENT (OPSI B) --}}
    <div class="relative overflow-hidden rounded-3xl border border-slate-700/70 bg-slate-900 shadow-2xl">
        {{-- Background Image dengan Dark Overlay --}}
        <div class="absolute inset-0 z-0 opacity-25 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d0fbb186a5b7?auto=format&fit=crop&w=1600&q=80');"></div>
        <div class="absolute inset-0 z-0 bg-gradient-to-r from-slate-950 via-slate-900/90 to-blue-950/70"></div>

        <div class="relative z-10 p-6 md:p-10">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-600/30 text-blue-400 border border-blue-500/40">
                            PT Tiga Cipta Selaras
                        </span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-950/80 text-emerald-400 border border-emerald-700/60 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> System Operational
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight">
                        SiteProgress Enterprise
                    </h1>
                    <p class="text-slate-300 text-sm md:text-base max-w-2xl leading-relaxed">
                        Sistem kendali dan pemantauan real-time pembangunan infrastruktur pabrik, pergudangan, serta fasilitas industri nasional.
                    </p>
                </div>
                
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('program.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-blue-600/30 transition-all text-center border border-blue-400/30">
                        Eksplorasi Modul Proyek &rarr;
                    </a>
                </div>
            </div>

            {{-- Metric Cards (Opsi B - Layout & Warna) --}}
            @php
                $stats = [
                    ['label' => 'Total Proyek Aktif', 'value' => '8 Situs', 'sub' => 'Jawa & Sumatera', 'icon' => '🏗️', 'color' => 'text-blue-400'],
                    ['label' => 'Rata-Rata Progres S-Curve', 'value' => '74.8%', 'sub' => '+3.2% Minggu Ini', 'icon' => '📈', 'color' => 'text-emerald-400'],
                    ['label' => 'Tenaga Kerja Lapangan', 'value' => '342 Orang', 'sub' => 'Presensi Terverifikasi', 'icon' => '👷‍♂️', 'color' => 'text-amber-400'],
                    ['label' => 'Insiden K3 (HSE)', 'value' => '0 Case', 'sub' => 'Zero Incident Target', 'icon' => '🛡️', 'color' => 'text-indigo-400'],
                ];
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 pt-6 border-t border-slate-700/60">
                @foreach($stats as $stat)
                    <div class="bg-slate-900/80 backdrop-blur border border-slate-700/60 rounded-2xl p-4 hover:border-blue-500/40 transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs text-slate-400 font-medium">{{ $stat['label'] }}</span>
                            <span class="text-lg">{{ $stat['icon'] }}</span>
                        </div>
                        <p class="text-2xl font-black text-white mb-0.5">{{ $stat['value'] }}</p>
                        <p class="text-[11px] {{ $stat['color'] }} font-semibold">{{ $stat['sub'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 2. DAFTAR PROYEK MONITORING REAL-TIME (OPSI B & C - STATUS CARDS WITH PROGRESS BAR) --}}
    <div class="space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Status Proyek Konstruksi Berjalan</h2>
                <p class="text-slate-400 text-sm">Update log progres harian langsung dari Site Manager di lapangan</p>
            </div>
        </div>

        @php
            $projects = [
                [
                    'code' => 'PRJ-TCS-001',
                    'title' => 'Pembangunan Pabrik Manufaktur Zonal A',
                    'location' => 'Kawasan Industri Cikarang',
                    'progress' => 82,
                    'status' => 'On Track',
                    'manager' => 'Ir. Hendra Gunawan',
                    'img' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=600&q=80'
                ],
                [
                    'code' => 'PRJ-TCS-002',
                    'title' => 'Gudang Logistik & Depo Kontainer',
                    'location' => 'Pelabuhan Tanjung Priok',
                    'progress' => 65,
                    'status' => 'Delayed',
                    'manager' => 'Budi Santoso, ST',
                    'img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=600&q=80'
                ],
                [
                    'code' => 'PRJ-TCS-003',
                    'title' => 'Fasilitas Pengolahan Limbah & Utilitas',
                    'location' => 'Kawasan Industri Karawang',
                    'progress' => 95,
                    'status' => 'Final Stage',
                    'manager' => 'Ahmad Faiz Muammar',
                    'img' => 'https://images.unsplash.com/photo-1590496793929-36417d3117de?auto=format&fit=crop&w=600&q=80'
                ],
            ];
        @endphp

        <div class="grid md:grid-cols-3 gap-6">
            @forelse($projects as $item)
                <div class="bg-slate-800/90 border border-slate-700/80 rounded-2xl overflow-hidden hover:border-blue-500/60 transition-all duration-300 flex flex-col justify-between group shadow-lg">
                    {{-- Visual Gambar Proyek --}}
                    <div class="relative h-44 overflow-hidden">
                        <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/30 to-transparent"></div>
                        
                        <div class="absolute top-3 left-3 right-3 flex justify-between items-center">
                            <span class="text-[11px] font-mono font-bold text-slate-200 bg-slate-950/80 px-2.5 py-1 rounded-lg border border-slate-700 backdrop-blur">
                                {{ $item['code'] }}
                            </span>

                            @switch($item['status'])
                                @case('On Track')
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-950/90 text-emerald-400 border border-emerald-700/80 backdrop-blur">On Track</span>
                                    @break
                                @case('Delayed')
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-rose-950/90 text-rose-400 border border-rose-700/80 backdrop-blur">Terhambat</span>
                                    @break
                                @default
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-blue-950/90 text-blue-400 border border-blue-700/80 backdrop-blur">Tahap Akhir</span>
                            @endswitch
                        </div>

                        <div class="absolute bottom-3 left-3 right-3">
                            <h3 class="text-base font-bold text-white line-clamp-1 group-hover:text-blue-400 transition-colors">{{ $item['title'] }}</h3>
                            <p class="text-xs text-slate-300 flex items-center gap-1 mt-0.5">
                                📍 {{ $item['location'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Isi Kartu & Progress Bar --}}
                    <div class="p-5 space-y-4">
                        <div class="space-y-1.5">
                            <div class="flex justify-between text-xs font-semibold">
                                <span class="text-slate-400">Capaian Progres Fisik</span>
                                <span class="text-blue-400 font-bold">{{ $item['progress'] }}%</span>
                            </div>
                            <div class="w-full bg-slate-900 rounded-full h-2.5 overflow-hidden border border-slate-700/80">
                                <div class="bg-gradient-to-r from-blue-600 to-cyan-400 h-2.5 rounded-full transition-all duration-500" style="width: {{ $item['progress'] }}%"></div>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-700/60 flex items-center justify-between text-xs text-slate-400">
                            <span>PIC Proyek:</span>
                            <strong class="text-slate-200 font-semibold">{{ $item['manager'] }}</strong>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10 bg-slate-800 rounded-2xl border border-slate-700 text-slate-400">
                    Belum ada data proyek yang terdaftar.
                </div>
            @endforelse
        </div>
    </div>

    {{-- 3. FITUR OPERASIONAL & MENU PINTAS LOGISTIK (OPSI B) --}}
    <div class="bg-slate-800/80 border border-slate-700/80 rounded-2xl p-6 md:p-8">
        <h3 class="text-xl font-bold text-white mb-2">Fitur Operasional Monitoring</h3>
        <p class="text-slate-400 text-sm mb-6">Akses cepat ke setiap modul operasional SiteProgress</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('program.detail', 'industrial') }}" class="p-5 bg-slate-900/90 hover:bg-slate-900 border border-slate-700/70 hover:border-blue-500/50 rounded-xl transition-all group">
                <span class="text-3xl mb-3 block">🏗️</span>
                <h4 class="font-bold text-white text-sm group-hover:text-blue-400 transition-colors">Log Progres Pabrik</h4>
                <p class="text-xs text-slate-400 mt-1">Struktur baja, cor beton, & zonasi</p>
            </a>
            <a href="{{ route('program.detail', 'warehouse') }}" class="p-5 bg-slate-900/90 hover:bg-slate-900 border border-slate-700/70 hover:border-blue-500/50 rounded-xl transition-all group">
                <span class="text-3xl mb-3 block">🚛</span>
                <h4 class="font-bold text-white text-sm group-hover:text-blue-400 transition-colors">Alat Berat & Material</h4>
                <p class="text-xs text-slate-400 mt-1">Excavator, crane, & supply barang</p>
            </a>
            <a href="{{ route('team.index') }}" class="p-5 bg-slate-900/90 hover:bg-slate-900 border border-slate-700/70 hover:border-blue-500/50 rounded-xl transition-all group">
                <span class="text-3xl mb-3 block">👷‍♂️</span>
                <h4 class="font-bold text-white text-sm group-hover:text-blue-400 transition-colors">Tim Pengembang</h4>
                <p class="text-xs text-slate-400 mt-1">Profil tim Syntax Builders</p>
            </a>
            <a href="{{ route('contact') }}" class="p-5 bg-slate-900/90 hover:bg-slate-900 border border-slate-700/70 hover:border-blue-500/50 rounded-xl transition-all group">
                <span class="text-3xl mb-3 block">📞</span>
                <h4 class="font-bold text-white text-sm group-hover:text-blue-400 transition-colors">Pusat Bantuan</h4>
                <p class="text-xs text-slate-400 mt-1">Kontak support SiteProgress</p>
            </a>
        </div>
    </div>

</div>
@endsection