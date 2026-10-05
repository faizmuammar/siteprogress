@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<div class="text-center py-16">
    <h1 class="text-6xl font-extrabold text-red-500 mb-4">404</h1>
    <h2 class="text-2xl font-bold text-white mb-2">Page Not Found</h2>
    <p class="text-slate-400 mb-6">The requested site resource does not exist or has been relocated.</p>
    <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition-all">Return to Home</a>
</div>
@endsection