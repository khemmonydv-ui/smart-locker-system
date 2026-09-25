
    <div class="min-h-screen bg-white" x-data="{ selected: null }">

        {{-- Header --}}
        <div class="flex items-center gap-4 px-6 py-5 border-b border-gray-200">
            <a href="{{ url()->previous() }}" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl font-bold text-gray-900">
                Lockers &mdash; {{ $facility ?? 'Facility' }}
            </h1>
        </div>

        <div class="px-6 py-6 max-w-5xl mx-auto">

            {{-- Legend --}}
            <div class="flex items-center gap-6 mb-4">
                <div class="flex items-center gap-2">
                    <span class="h-3 w-3 rounded-full bg-green-600"></span>
                    <span class="text-sm text-green-700">Available</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-3 w-3 rounded-full bg-red-400"></span>
                    <span class="text-sm text-red-500">In Use</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-3 w-3 rounded-full bg-amber-500"></span>
                    <span class="text-sm text-amber-600">Maintenance</span>
                </div>
            </div>

            {{-- Locker grid --}}
            <div class="border border-gray-200 rounded-2xl p-6 shadow-sm">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach ($lockers as $locker)
                            @php
                                $status = $locker['status'];
                                $isAvailable = $status === 'available';

                                $classes = match ($status) {
                                    'available'   => 'bg-green-600 hover:bg-green-700 cursor-pointer',
                                    'in_use'      => 'bg-red-400 cursor-not-allowed opacity-95',
                                    'maintenance' => 'bg-amber-500 cursor-not-allowed opacity-95',
                                    default       => 'bg-gray-300 cursor-not-allowed',
                                };
                                @endphp

                        <button
                            type="button"
                            @if ($isAvailable)
                                @click="selected = '{{ $locker['code'] }}'"
                                :class="selected === '{{ $locker['code'] }}' ? 'ring-4 ring-green-300' : ''"
                            @else
                                disabled
                            @endif
                            class="{{ $classes }} text-white rounded-xl py-4 px-4 flex flex-col items-center justify-center gap-1 transition"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2a4 4 0 0 0-4 4v3H7a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2h-1V6a4 4 0 0 0-4-4Zm-2 7V6a2 2 0 1 1 4 0v3Z" />
                            </svg>
                            <span class="font-bold text-sm">{{ $locker['code'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <p class="text-center text-sm text-gray-400 mt-4">
                <span x-show="!selected">Tap a green locker to select it</span>
                <span x-show="selected" x-cloak>Selected locker: <span class="font-semibold text-gray-600" x-text="selected"></span></span>
            </p>

        </div>
    </div>
