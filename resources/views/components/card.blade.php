@props(['title', 'category' => null, 'badge' => null])

<div class="bg-slate-800 border border-slate-700 rounded-xl p-6 hover:border-blue-500/50 transition-all duration-200">
    @if($badge)
        <span class="text-xs font-bold uppercase tracking-wider bg-blue-900/50 text-blue-400 px-2.5 py-1 rounded border border-blue-700/50">
            {{ $badge }}
        </span>
    @endif
    <h3 class="text-xl font-bold text-white mt-3 mb-2">{{ $title }}</h3>
    <div class="text-slate-300 text-sm leading-relaxed">
        {{ $slot }}
    </div>
</div>