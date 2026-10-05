@extends('layouts.app')

@section('title', 'Home - SiteProgress')

@section('content')
<div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 md:p-12 shadow-xl">
    <span class="text-blue-400 text-xs font-bold uppercase tracking-wider bg-blue-900/50 px-3 py-1 rounded-md border border-blue-700/50">Industrial Monitoring</span>
    <h1 class="text-4xl font-extrabold text-white mt-4 mb-3">Enterprise Construction Monitoring</h1>
    <p class="text-slate-300 text-lg leading-relaxed max-w-3xl mb-8">
        Real-time site management solution tailored for large-scale factory construction and warehouse logistics developments.
    </p>
    <div class="flex gap-4">
        <a href="{{ route('program.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg transition-all">Explore Solutions</a>
        <a href="{{ route('team.index') }}" class="bg-slate-700 hover:bg-slate-600 text-white font-semibold px-6 py-3 rounded-lg transition-all">Meet Our Team</a>
    </div>
</div>
@endsection