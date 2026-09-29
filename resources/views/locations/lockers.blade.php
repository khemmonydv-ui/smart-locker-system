<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $location->name }} Lockers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

@php
    $filters = [
        'all' => 'All',
        'available' => 'Available',
        'in_use' => 'In Use',
        'maintenance' => 'Maintenance',
    ];
@endphp

<div class="max-w-2xl mx-auto bg-white min-h-screen">

    <x-page-header
        :title="$location->name . ' Lockers'"
        :back="route('locations.details_locations', $location)"
    />

    <div class="p-4 sm:p-6">

        <div class="flex flex-wrap gap-2 mb-4">
            @foreach ($filters as $key => $label)
                
                    href="{{ route('locations.lockers', ['location' => $location, 'status' => $key]) }}"
                    class="px-4 py-2 rounded-full text-sm font-medium transition whitespace-nowrap {{ $status === $key ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}"
                >
                    {{ $label }} ({{ $key === 'all' ? $total : $counts->get($key, 0) }})
                </a>
            @endforeach
        </div>

        @if ($lockers->isEmpty())
            <p class="text-center text-sm text-gray-400 mt-10">No lockers found.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach ($lockers as $locker)
                    <x-locker-tile
                        :name="$locker->name"
                        :size="$locker->size"
                        :status="$locker->status"
                    />
                @endforeach
            </div>
        @endif
    </div>
</div>
</body>
</html>
