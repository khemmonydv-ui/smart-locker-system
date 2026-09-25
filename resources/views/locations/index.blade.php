<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Locations</title>
    {{-- Swap this CDN tag for your compiled Tailwind build (Vite) in production --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="mx-auto ml-20 mr-20 bg-white w-full ...">

    {{-- Header --}}
    <div class="flex items-center gap-4 px-4 py-4 border-b border-gray-100">
    <a href="{{ url('/users/dashboard') }}" class="text-gray-700">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </a>
    <h1 class="text-base font-semibold text-gray-900">Locations</h1>
</div>

    <div class="p-4">
        <form action="{{ route('locations.index') }}" method="GET" id="location-filters">
            <input type="hidden" name="filter" value="{{ $filter }}" id="filter-input">

            {{-- Search --}}
            <div class="relative mb-4">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search Locations..."
                    oninput="debounceSubmit()"
                    class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-full text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            {{-- Filter tabs --}}
            <div class="flex gap-2 mb-4">
                <x-filter-pill :active="$filter === 'all'" onclick="setFilter('all')">
                    All Location
                </x-filter-pill>
                <x-filter-pill :active="$filter === 'open'" onclick="setFilter('open')">
                    Open Now
                </x-filter-pill>
            </div>
        </form>

        {{-- Results --}}
        @forelse ($locations as $location)
            <x-location-card
                :name="$location->name"
                :address="$location->address"
                :distance="$location->distance_km"
                :available="$location->available_slots"
                :is-open="$location->is_open"
            />
        @empty
            <p class="text-center text-sm text-gray-400 mt-10">No locations match your search.</p>
        @endforelse
    </div>
</div>

<script>
    let debounceTimer;
    function debounceSubmit() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => document.getElementById('location-filters').submit(), 400);
    }
    function setFilter(value) {
        document.getElementById('filter-input').value = value;
        document.getElementById('location-filters').submit();
    }
</script>
</body>
</html>
