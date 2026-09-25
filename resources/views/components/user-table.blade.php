@props([
    'users',
    'searchPlaceholder' => 'Search by name, email, phone, locker, status...',
])

@php
    // unique id so multiple instances of this component on one page never collide
    $tableId = 'userTable_' . uniqid();
@endphp

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5" data-user-table>

    {{-- search --}}
    <div class="flex items-center w-full max-w-2xl mb-5">
        <div class="relative w-full">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35m1.35-5.15a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
            </svg>
            <input
                type="text"
                data-user-search
                placeholder="{{ $searchPlaceholder }}"
                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-700
                       placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400
                       transition"
            >
        </div>
    </div>

    {{-- table --}}
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-sm" id="{{ $tableId }}">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs font-medium border-b border-gray-200">
                    <th class="text-left px-5 py-3">User</th>
                    <th class="text-left px-5 py-3">Email</th>
                    <th class="text-left px-5 py-3">Phone</th>
                    <th class="text-left px-5 py-3">Sessions</th>
                    <th class="text-left px-5 py-3">Active Locker</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody data-user-body class="divide-y divide-gray-100">
                @forelse ($users as $user)
                    <tr class="user-row hover:bg-gray-50/70 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold text-white shrink-0"
                                     style="background-color: {{ '#'.substr(md5($user->name), 0, 6) }}">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="text-gray-800 font-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $user->email }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $user->phone }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $user->sessions }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $user->active_locker }}</td>
                        <td class="px-5 py-3.5">
                            @php
                                $statusStyles = [
                                    'active'   => 'bg-emerald-50 text-emerald-600',
                                    'inactive' => 'bg-gray-100 text-gray-500',
                                    'blocked'  => 'bg-rose-50 text-rose-600',
                                ];
                                $style = $statusStyles[strtolower($user->status)] ?? 'bg-gray-100 text-gray-500';
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $style }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ \Illuminate\Support\Facades\Route::has('users.show') ? route('users.show', $user->id) : '#' }}"
                                   class="text-indigo-500 hover:text-indigo-700 transition" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                                <a href="{{ \Illuminate\Support\Facades\Route::has('users.edit') ? route('users.edit', $user->id) : '#' }}"
                                   class="text-rose-500 hover:text-rose-700 transition" title="Manage user">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-10 text-center text-gray-400">No users yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p data-no-results class="hidden px-5 py-8 text-center text-gray-400 text-sm">
            No users match your search.
        </p>
    </div>

</div>

@once
    @push('scripts')
    <script>
        // wires up every [data-user-table] instance on the page, so the
        // component works no matter how many times it's dropped in
        document.querySelectorAll('[data-user-table]').forEach(function (wrapper) {
            const input = wrapper.querySelector('[data-user-search]');
            const rows = Array.from(wrapper.querySelectorAll('[data-user-body] .user-row'));
            const noResults = wrapper.querySelector('[data-no-results]');

            if (!input) return;

            input.addEventListener('input', function () {
                const term = this.value.trim().toLowerCase();
                let visibleCount = 0;

                rows.forEach(function (row) {
                    const matches = row.textContent.toLowerCase().includes(term);
                    row.classList.toggle('hidden', !matches);
                    if (matches) visibleCount++;
                });

                noResults.classList.toggle('hidden', visibleCount !== 0);
            });
        });
    </script>
    @endpush
@endonce