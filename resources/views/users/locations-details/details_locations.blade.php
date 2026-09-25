<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $location->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="bg-white w-full max-w-2xl mx-5 min-h-screen">

    <x-page-header :title="$location->name" :back="route('locations.index')" />

    <div class="p-4 sm:p-6">
        <div class="rounded-2xl bg-gradient-to-b from-blue-100 to-blue-50 py-10 text-center mb-4">
            <svg class="w-8 h-8 mx-auto mb-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <p class="text-sm font-semibold text-blue-700 px-4">{{ $location->address }}</p>
        </div>

        <div class="rounded-2xl border border-gray-200 p-4 mb-4">
            <div class="flex items-start justify-between gap-3 mb-3">
                <h2 class="text-lg font-bold text-gray-900 break-words">{{ $location->name }}</h2>
                <span class="shrink-0 text-xs font-medium px-2.5 py-1 rounded-full {{ $location->is_open ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                    {{ $location->is_open ? 'Open' : 'Closed' }}
                </span>
            </div>

            <div class="space-y-2 text-sm text-gray-500">
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>{{ $location->address }}</span>
                </div>
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $location->opening_hours }}</span>
                </div>
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>{{ $location->phone }}</span>
                </div>
            </div>

            @if($location->description)
                <p class="text-sm text-gray-400 mt-3">{{ $location->description }}</p>
            @endif
        </div>

        <div class="rounded-2xl border border-gray-200 p-4 mb-4">
            <h3 class="text-sm font-semibold text-gray-900 mb-3">Locker Availability</h3>
            <div class="grid grid-cols-3 gap-2 sm:gap-3">
                <x-stat-box :value="$available" label="Available" color="green" />
                <x-stat-box :value="$inUse" label="In Use" color="red" />
                <x-stat-box :value="$maintenance" label="Maintenance" color="orange" />
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-gray-500 mb-4 px-1">
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-green-500"></span> Available</span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-red-500"></span> In Use</span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-orange-500"></span> Maintenance</span>
        </div>

        <a href="#" class="flex items-center justify-center gap-2 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-4">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0m-8 4h8a2 2 0 012 2v5a2 2 0 01-2 2H8a2 2 0 01-2-2v-5a2 2 0 012-2z" />
            </svg>
            View Lockers
        </a>
    </div>
</div>
</body>
</html>
