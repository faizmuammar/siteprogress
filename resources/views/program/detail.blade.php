@extends('layouts.app')

@section('title', 'Program Details - SiteProgress')

@section('content')
<div class="bg-slate-800 border border-slate-700 rounded-xl p-8">
    <span class="text-xs text-blue-400 uppercase font-bold tracking-widest">Program Module</span>
    <h1 class="text-3xl font-bold text-white mt-1 capitalize">{{ $category }} Construction Solution</h1>
    <p class="text-slate-300 mt-4 leading-relaxed">
        This program module manages site progress, manpower, and machinery logs for <strong>{{ $category }}</strong> scale projects.
    </p>
    <div class="mt-6">
        <a href="{{ route('program.index') }}" class="text-sm text-slate-400 hover:text-white">&larr; Back to all programs</a>
    </div>
</div>
@endsection