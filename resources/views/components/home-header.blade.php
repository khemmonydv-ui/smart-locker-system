@props([
    'name',
    'searchAction' => '#',
])

@php
    $hour = now()->hour;
    $greeting = $hour > 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');
    $initial = mb_strtoupper(mb_substr($name, 0, 1));
@endphp


<div class="bg-gradient-to-br from-rose-800 to-rose-700 px-5 pb-8 pt-6">
    <div class="flex items-start justify-between mx-20">
        <div>
            <p class="text-sm text-rose-100">{{ $greeting }}</p>
            <h1 class="mt-0.5 text-2xl font-bold text-white">{{ $name }} <span>👋</span></h1>
            <p class="mt-1 text-xs text-rose-100">Find a locker near you</p>
        </div>

        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-teal-400 text-sm font-semibold text-white">
            B
        </div>
    </div>

    <div class="relative mt-5 mx-20">
        {{-- search icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-rose-200" aria-hidden="true">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
        </svg>
        <input
            type="text"
            placeholder="Search Locations..."
            class="w-full rounded-full border border-rose-400/40 bg-rose-700/40 py-2.5 pl-10 pr-4 text-sm text-white placeholder-rose-200 focus:outline-none focus:ring-2 focus:ring-white/30"
        />
    </div>
</div>
