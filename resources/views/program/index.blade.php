@extends('layouts.app')

@section('title', 'Our Programs - SiteProgress')

@section('content')
<h1 class="text-3xl font-bold text-white mb-6">Industrial Solutions & Programs</h1>
<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-slate-800 border border-slate-700 rounded-xl p-6">
        <h2 class="text-xl font-bold text-blue-400 mb-2">Factory Construction Monitoring</h2>
        <p class="text-slate-300 mb-4 text-sm">Automated tracking for multi-zone industrial manufacturing plants.</p>
        <a href="{{ route('program.detail', 'industrial') }}" class="text-blue-400 hover:underline font-semibold text-sm">View Solution Details &rarr;</a>
    </div>
    <div class="bg-slate-800 border border-slate-700 rounded-xl p-6">
        <h2 class="text-xl font-bold text-blue-400 mb-2">Logistics Warehouse Development</h2>
        <p class="text-slate-300 mb-4 text-sm">High-capacity structural steel and bay progress logging.</p>
        <a href="{{ route('program.detail', 'warehouse') }}" class="text-blue-400 hover:underline font-semibold text-sm">View Solution Details &rarr;</a>
    </div>
</div>
@endsection