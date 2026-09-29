@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="font-sans">

    <x-home-header name="Bora" />

    <div class="mx-5 md:mx-20 pb-8">
        @if ($activeUsage)
            <x-active-locker :usage="$activeUsage" />
        @endif

        <x-find-locker-banner />

        {{-- Nearby locations --}}
        <div class="mb-3 flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900">Nearby Locations</h2>
            <a href="{{ route('locations.index') }}" class="text-sm font-medium text-indigo-600">View all</a>
        </div>
        <div class="space-y-3">
            @foreach ($locations as $location)
                <x-locker-card
                    :href="route('locations.details_locations', $location)"
                    :name="$location->name"
                    :details="$location->distance_km . ' km · ' . $location->available_slots . ' available'"
                    :status="$location->is_open ? 'Open' : 'Closed'"
                    :status-class="$location->is_open ? 'text-emerald-600' : 'text-gray-400'"
                />
            @endforeach
        </div>

        {{-- Recent activity --}}
        <div class="mt-6">
            <div class="mb-3 flex items-center justify-between">
                <h2 class="text-base font-semibold text-gray-900">Recent Activity</h2>
            </div>
            <div class="space-y-3">
                <x-locker-card status="Active" />
                <x-locker-card status="Completed" status-class="text-indigo-600" />
            </div>
        </div>
    </div>
</div>
