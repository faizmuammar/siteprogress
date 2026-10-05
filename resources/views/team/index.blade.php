@extends('layouts.app')

@section('title', 'Our Team - Syntax Builders')

@section('content')
<h1 class="text-3xl font-bold text-white mb-2">BuildTech Dev Team</h1>
<p class="text-slate-400 mb-8">Syntax Builders Development Squad</p>

<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-slate-800 border border-blue-500/30 rounded-xl p-6">
        <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">Ketua Tim</span>
        <h2 class="text-2xl font-bold text-white mt-1">Ahmad Faiz Muammar</h2>
        <p class="text-slate-400 text-sm mb-4">NIM: 241012003</p>
        <p class="text-slate-300 text-sm mb-4">Backend Architecture & Relational Database Integration.</p>
        <a href="{{ route('team.detail', 'ahmad-faiz') }}" class="text-blue-400 text-sm font-semibold hover:underline">View Member Profile &rarr;</a>
    </div>
    <div class="bg-slate-800 border border-indigo-500/30 rounded-xl p-6">
        <span class="text-xs font-bold text-indigo-400 uppercase tracking-widest">Anggota</span>
        <h2 class="text-2xl font-bold text-white mt-1">Muzakki Abdul Wafi</h2>
        <p class="text-slate-400 text-sm mb-4">NIM: 2410120013</p>
        <p class="text-slate-300 text-sm mb-4">Frontend UI/UX & Responsive Blade Template Development.</p>
        <a href="{{ route('team.detail', 'muzakki-wafi') }}" class="text-indigo-400 text-sm font-semibold hover:underline">View Member Profile &rarr;</a>
    </div>
</div>
@endsection