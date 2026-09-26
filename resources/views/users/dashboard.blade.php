@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class=" font-sans">

    <x-home-header name="Bora" />

    <div class="mx-20 pb-8">
        <x-active-locker />

        <x-find-locker-banner />

        {{-- Nearby locations --}}
        <div class="mb-3 flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900">Nearby Locations</h2>
            <a href="#" class="text-sm font-medium text-indigo-600">View all</a>
        </div>
        <div class="space-y-3">
            <x-locker-card />
            <x-locker-card />
            <x-locker-card />
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
