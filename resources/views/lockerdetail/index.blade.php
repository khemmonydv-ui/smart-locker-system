<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lockers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none !important}</style>
</head>
<body class="bg-white text-gray-900">
<div x-data="{ open: false, lockerId: null, lockerName: '' }">

    {{-- Header with back arrow --}}
    <header class="flex items-center gap-4 px-6 sm:px-12 py-5 border-b">
        <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-800">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">
            Lockers @if ($location) — {{ $location->name }} @endif
        </h1>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-6">

        @if (session('status'))
            <p class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('status') }}</p>
        @endif

        @if (! $location)
            <p class="text-center text-gray-500 mt-10">No location yet.</p>
        @else
            {{-- Legend --}}
            <div class="flex gap-6 text-sm mb-4">
                <span class="flex items-center gap-2 text-green-700">
                    <span class="w-3 h-3 rounded-full bg-green-600"></span> Available
                </span>
                <span class="flex items-center gap-2 text-red-500">
                    <span class="w-3 h-3 rounded-full bg-red-400"></span> In Use
                </span>
                <span class="flex items-center gap-2 text-orange-500">
                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span> Maintenance
                </span>
            </div>

            {{-- Locker grid, in a bordered card like the mockup --}}
            <div class="grid grid-cols-3 gap-3 border rounded-2xl p-4">
                @forelse ($lockers as $locker)
                    @php
                        $color = match ($locker->status) {
                            'available' => 'bg-green-600 hover:bg-green-700 cursor-pointer',
                            'in_use'    => 'bg-red-400 cursor-not-allowed',
                            default     => 'bg-yellow-400 cursor-not-allowed', // maintenance
                        };
                    @endphp

                    @if ($locker->status === 'available')
                        <button type="button"
                                @click="open = true; lockerId = {{ $locker->id }}; lockerName = '{{ $locker->name }}'"
                                class="{{ $color }} h-16 rounded-xl text-white font-bold flex flex-col items-center justify-center">
                            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>
                            </svg>
                            {{ $locker->name }}
                        </button>
                    @else
                        <div class="{{ $color }} h-16 rounded-xl text-white font-bold flex flex-col items-center justify-center">
                            <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>
                            </svg>
                            {{ $locker->name }}
                        </div>
                    @endif
                @empty
                    <p class="col-span-3 text-center text-gray-500 py-6">No lockers yet.</p>
                @endforelse
            </div>

            <p class="text-center text-xs text-gray-500 mt-6">Tap a green locker to select it</p>
        @endif
    </main>

    {{-- Popup: create PIN --}}
    <div x-show="open" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-sm" @click.outside="open = false">
            <h3 class="text-lg font-bold mb-1">Use locker <span x-text="lockerName"></span></h3>
            <p class="text-sm text-gray-500 mb-4">Create a 6-digit PIN to unlock it.</p>

            <form method="POST" action="{{ route('locker.use') }}" class="space-y-3">
                @csrf
                <input type="hidden" name="locker_id" :value="lockerId">

                <input type="password" name="pin" inputmode="numeric" maxlength="6"
                       placeholder="6-digit PIN" class="w-full border p-2 rounded">
                @error('pin') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

                <input type="password" name="pin_confirmation" inputmode="numeric" maxlength="6"
                       placeholder="Confirm PIN" class="w-full border p-2 rounded">

                <div class="flex gap-2 justify-end">
                    <button type="button" @click="open = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button class="px-4 py-2 bg-green-600 text-white rounded font-semibold">Use This Locker</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html> 