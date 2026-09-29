

    <x-app-layout>
    <div
        class="min-h-screen bg-white"
        x-data="{
            startedAt: {{ isset($locker['started_at']) ? $locker['started_at']->timestamp * 1000 : 'null' }},
            elapsed: '00:00:00',
            pinOpen: {{ $errors->has('pin') ? 'true' : 'false' }},
            pin: '',
            tick() {
                if (!this.startedAt) return;
                const diff = Math.max(0, Date.now() - this.startedAt);
                const h = String(Math.floor(diff / 3600000)).padStart(2, '0');
                const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                const s = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
                this.elapsed = `${h}:${m}:${s}`;
            }
        }"
        x-init="tick(); setInterval(() => tick(), 1000)">
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
 
        <div class="px-6 py-6 max-w-3xl mx-auto">
 
            {{-- Locker card --}}
            <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm mb-4">
 
                {{-- Blue header block --}}
                <div class="bg-blue-700 py-8 px-6 flex flex-col items-center text-center">
                    <div class="bg-blue-600 rounded-xl p-3 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2Zm10-10V7a4 4 0 1 0-8 0" />
                        </svg>
                    </div>
                    <p class="text-3xl font-extrabold text-white">{{ $locker['code'] }}</p>
 
                    @php
                        $statusStyles = match ($locker['status']) {
                            'available'   => 'bg-green-100 text-green-700',
                            'in_use'      => 'bg-red-200 text-red-600',
                            'maintenance' => 'bg-amber-100 text-amber-700',
                            default       => 'bg-gray-100 text-gray-600',
                        };
                        $statusLabel = match ($locker['status']) {
                            'available'   => 'Available',
                            'in_use'      => 'In Use',
                            'maintenance' => 'Maintenance',
                            default       => 'Unknown',
                        };
                    @endphp
                    <span class="mt-2 text-sm font-semibold px-2.5 py-1 rounded-full {{ $statusStyles }}">
                        {{ $statusLabel }}
                    </span>
                </div>
 
                {{-- Details --}}
                <div class="px-6 py-5">
                    <div class="flex items-center gap-2 text-gray-600 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-blue-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657 13.414 20.9a2 2 0 0 1-2.828 0l-4.243-4.243a8 8 0 1 1 11.314 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="text-lg">{{ $locker['address'] }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-lg">{{ $locker['hours'] }}</span>
                    </div>
 
                    <div class="text-center mt-6">
                        <p class="text-2sm text-gray-400 mb-1">Duration</p>
                        <p class="text-3xl font-bold text-gray-900" x-text="elapsed"></p>
                    </div>
                </div>
            </div>
 
            {{-- Unlock button --}}
            <form method="POST" action="{{ route('lockerdetail.yourlocker.unlock', $locker['code']) }}">
                @csrf
                <button
                    type="button"
                    @click="pin = ''; pinOpen = true; $nextTick(() => $refs.pinInput.focus())"
                    class="w-full flex items-center justify-center gap-2 border border-gray-200 rounded-xl py-3.5 font-semibold text-gray-900 hover:bg-gray-50 transition mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2Zm10-10V7a4 4 0 1 0-8 0" />
                    </svg>
                    Unlock Locker
                </button>
            </form>
 
            {{-- Release button --}}
           <form method="POST" action="{{ route('lockerdetail.yourlocker.release', $locker['code']) }}">
                @csrf
                @method('PATCH')
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 rounded-xl py-3.5 font-semibold text-white text-xl transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0-4-4m4 4H7m6 4v1a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1" />
                    </svg>
                    Release Locker
                </button>
            </form>
            {{-- PIN confirm --}}
<div
    x-show="pinOpen"
    x-cloak
    x-transition.opacity
    @click.self="pinOpen = false"
    @keydown.escape.window="pinOpen = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
>
    <form
        method="POST"
        action="{{ route('lockerdetail.yourlocker.unlock', $locker['code']) }}"
        class="bg-white rounded-2xl w-full max-w-sm shadow-xl p-6"
    >
        @csrf

        <h2 class="text-lg font-bold text-gray-900 mb-1">Confirm your PIN</h2>
        <p class="text-sm text-gray-500 mb-4">Enter the 6-digit PIN you created for locker {{ $locker['code'] }}.</p>

        <input
            x-ref="pinInput"
            type="password"
            name="pin"
            :value="pin"
            @input="$event.target.value = $event.target.value.replace(/\D/g, '').slice(0, 6); pin = $event.target.value"
            inputmode="numeric"
            maxlength="6"
            autocomplete="off"
            placeholder="••••••"
            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-center text-xl tracking-[0.5em] focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        @error('pin')
            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <div class="flex gap-3 mt-5">
            <button
                type="button"
                @click="pinOpen = false"
                class="flex-1 border border-blue-600 text-blue-600 font-semibold rounded-xl py-3 hover:bg-blue-50 transition"
            >
                Cancel
            </button>
            <button
                type="submit"
                :disabled="pin.length !== 6"
                class="flex-1 bg-blue-600 text-white font-semibold rounded-xl py-3 hover:bg-blue-700 transition disabled:opacity-40 disabled:cursor-not-allowed"
            >
                Confirm
            </button>
        </div>
    </form>
</div>
 
        </div>
    </div>
    
</x-app-layout>

