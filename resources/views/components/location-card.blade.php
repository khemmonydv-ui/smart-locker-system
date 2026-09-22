@props([
    'name',
    'address',
    'distance' => null,
    'available' => null,
    'isOpen' => true,
])

<a href="#" class="block rounded-2xl border border-gray-200 px-4 py-3 mb-3 hover:border-indigo-300 hover:shadow-sm transition">
    <div class="flex items-start justify-between gap-3">
        <div class="flex items-start gap-2 min-w-0">
            <svg class="w-4 h-4 mt-0.5 text-indigo-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-gray-900 truncate">{{ $name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ $address }}</p>
            </div>
        </div>

        <div class="flex items-center gap-1 shrink-0">
            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $isOpen ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                {{ $isOpen ? 'Open' : 'Closed' }}
            </span>
            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </div>

    @if($distance !== null || $available !== null)
        <div class="flex mt-3 pt-3 border-t border-gray-100">
            @if($distance !== null)
                <div class="flex-1 text-center">
                    <p class="text-xs text-gray-400">Distance</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $distance }} km</p>
                </div>
            @endif
            @if($available !== null)
                <div class="flex-1 text-center">
                    <p class="text-xs text-gray-400">Available</p>
                    <p class="text-sm font-semibold {{ $available > 0 ? 'text-green-600' : 'text-gray-400' }}">{{ $available }}</p>
                </div>
            @endif
        </div>
    @endif
</a>
