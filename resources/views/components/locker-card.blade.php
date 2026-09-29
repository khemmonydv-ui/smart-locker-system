@props(['status' => 'Open', 'statusClass' => 'text-emerald-600'])

<div class="flex items-center justify-between rounded-2xl border border-gray-200 bg-white px-4 py-3">
    <div class="flex items-center gap-3">
        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600">
            {{-- map-pin icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="h-5 w-5 text-white" aria-hidden="true">
                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                <circle cx="12" cy="10" r="3" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-900">Central Library</p>
            <p class="text-xs text-gray-400">1.2 km · 24/40 available</p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <span class="text-xs font-medium {{ $statusClass }}">{{ $status }}</span>
        {{-- chevron --}}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="h-4 w-4 text-gray-300" aria-hidden="true">
            <path d="m9 18 6-6-6-6" />
        </svg>
    </div>
</div>
