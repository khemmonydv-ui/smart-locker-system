@props(['usage'])

<a href="{{ route('locker.show') }}" class="mb-4 flex items-center justify-between rounded-2xl border border-indigo-200 bg-white px-4 py-3 shadow-sm hover:shadow transition">
    <div class="flex items-center gap-3">
        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="h-5 w-5 text-white" aria-hidden="true">
                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
            </svg>
        </div>
        <div>
            <p class="text-xs font-medium text-indigo-600">Active Locker</p>
            <p class="text-sm font-semibold text-gray-900">Locker {{ $usage->locker->name }} · {{ $usage->locker->location->name }}</p>
            <p class="text-xs text-gray-400" id="active-locker-duration" data-started-at="{{ $usage->started_at->toIso8601String() }}">Duration: 00:00</p>
        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
         class="h-4 w-4 text-gray-300" aria-hidden="true">
        <path d="m9 18 6-6-6-6" />
    </svg>
</a>

<script>
    (function () {
        const el = document.getElementById('active-locker-duration');
        if (!el) return;
        const startedAt = new Date(el.dataset.startedAt).getTime();
        function tick() {
            const diff = Math.max(0, Date.now() - startedAt);
            const totalMinutes = Math.floor(diff / 60000);
            const h = String(Math.floor(totalMinutes / 60)).padStart(2, '0');
            const m = String(totalMinutes % 60).padStart(2, '0');
            el.textContent = `Duration: ${h}:${m}`;
        }
        tick();
        setInterval(tick, 1000);
    })();
</script>
