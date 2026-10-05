@extends('layouts.app')

@section('title', 'Team Profile - SiteProgress')

@section('content')
<div class="bg-slate-800 border border-slate-700 rounded-xl p-8 max-w-2xl">
    <span class="text-xs text-blue-400 font-bold uppercase tracking-widest">Team Profile</span>
    <h1 class="text-3xl font-bold text-white mt-1 capitalize">{{ $memberName }}</h1>
    <p class="text-slate-400 text-sm mt-1 mb-4">Developer Profile ID: {{ $member }}</p>
    <p class="text-slate-300 leading-relaxed">
        Active contributor for SiteProgress Enterprise Web Application. Responsible for architectural design, code quality, and project deliverables.
    </p>
    <div class="mt-6">
        <a href="{{ route('team.index') }}" class="text-sm text-slate-400 hover:text-white">&larr; Back to Team List</a>
    </div>
</div>
@endsection