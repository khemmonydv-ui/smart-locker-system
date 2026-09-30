@props([
    'users',
    'searchPlaceholder' => 'Search by name, email, locker, status...',
])

@php
    $tableId = 'userTable_' . uniqid();
    $statusStyles = [
        'active'   => 'bg-emerald-50 text-emerald-600',
        'inactive' => 'bg-gray-100 text-gray-500',
        'blocked'  => 'bg-rose-50 text-rose-600',
    ];
@endphp

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5"
     data-user-table
     data-has-errors="{{ $errors->any() ? '1' : '0' }}">

    {{-- success message --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- search + add button --}}
    <div class="flex items-center justify-between gap-3 mb-5">
        <div class="relative w-full max-w-2xl">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35m1.35-5.15a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
            </svg>
            <input type="text" data-user-search placeholder="{{ $searchPlaceholder }}"
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-700
                          placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30
                          focus:border-indigo-400 transition">
        </div>


    </div>

    {{-- table --}}
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-sm" id="{{ $tableId }}">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs font-medium border-b border-gray-200">
                    <th class="text-left px-5 py-3">User</th>
                    <th class="text-left px-5 py-3">Email</th>
                    <th class="text-left px-5 py-3">Sessions</th>
                    <th class="text-left px-5 py-3">Active Locker</th>
                    <th class="text-left px-5 py-3">Status</th>
                    <th class="text-right px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody data-user-body class="divide-y divide-gray-100">
                @forelse ($users as $user)
                    @php
                        $status   = strtolower($user->status ?? 'active');
                        $style    = $statusStyles[$status] ?? 'bg-gray-100 text-gray-500';
                        $color    = '#' . substr(md5($user->name), 0, 6);
                        $sessions = $user->sessions ?? 0;
                        $locker   = $user->active_locker ?? '-';
                    @endphp
                    <tr class="user-row hover:bg-gray-50/70 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold text-white shrink-0"
                                     style="background-color: {{ $color }}">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="text-gray-800 font-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $user->email }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $sessions }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $locker }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $style }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-end gap-3">

                                {{-- eye: open details pop-up --}}
                                <button type="button" data-view-user
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-joined="{{ $user->created_at?->format('d M Y') }}"
                                        data-sessions="{{ $sessions }}"
                                        data-locker="{{ $locker }}"
                                        data-status="{{ ucfirst($status) }}"
                                        data-status-style="{{ $style }}"
                                        data-color="{{ $color }}"
                                        class="text-indigo-500 hover:text-indigo-700 transition" title="View">
                                    
                                        <i class="w-4 h-4 fa-solid fa-eye"></i>
                                    
                                </button>

                                {{-- user button: toggle active / inactive --}}
                                <form method="POST" action="{{ route('users.toggle-status', $user) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="{{ $status === 'active' ? 'text-rose-500 hover:text-rose-700' : 'text-emerald-500 hover:text-emerald-700' }} transition"
                                            title="{{ $status === 'active' ? 'Set inactive' : 'Set active' }}">
                                            <i class="w-4 h-4 fa-solid fa-user"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-gray-400">No users yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p data-no-results class="hidden px-5 py-8 text-center text-gray-400 text-sm">
            No users match your search.
        </p>
    </div>

    {{-- ===== details pop-up ===== --}}
    <div data-view-modal class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40 p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-sm font-semibold text-gray-800">User Details</h3>
                <button type="button" data-close-modal class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-6 py-5">
                <div class="flex flex-col items-center mb-5">
                    <div data-v-avatar class="w-14 h-14 rounded-full flex items-center justify-center text-xl font-semibold text-white"></div>
                    <p data-v-name class="mt-3 text-sm font-semibold text-gray-800"></p>
                    <span data-v-status class="mt-1 inline-flex px-3 py-0.5 rounded-full text-xs font-medium"></span>
                </div>

                <dl class="text-sm divide-y divide-gray-100">
                    <div class="flex justify-between py-2.5">
                        <dt class="text-gray-500">Email</dt>
                        <dd data-v-email class="text-gray-800"></dd>
                    </div>
                    <div class="flex justify-between py-2.5">
                        <dt class="text-gray-500">Joined</dt>
                        <dd data-v-joined class="text-gray-800"></dd>
                    </div>
                    <div class="flex justify-between py-2.5">
                        <dt class="text-gray-500">Total Sessions</dt>
                        <dd data-v-sessions class="text-gray-800"></dd>
                    </div>
                    <div class="flex justify-between py-2.5">
                        <dt class="text-gray-500">Active Locker</dt>
                        <dd data-v-locker class="text-gray-800"></dd>
                    </div>
                </dl>

                <button type="button" data-close-modal
                        class="mt-5 w-full py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    Close
                </button>
            </div>
        </div>
    </div>

    {{-- ===== add user pop-up ===== --}}
    <div data-add-modal class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40 p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-sm font-semibold text-gray-800">Add User</h3>
                <button type="button" data-close-modal class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('staff.user.store') }}" class="px-6 py-5 space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                    @error('name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                    @error('email') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                    @error('password') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Confirm password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                </div>

                <div class="flex gap-3 pt-1">
                    <button type="button" data-close-modal
                            class="flex-1 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@once
    @push('scripts')
    <script>
        document.querySelectorAll('[data-user-table]').forEach(function (wrapper) {

            // ---------- search ----------
            const input = wrapper.querySelector('[data-user-search]');
            const rows = Array.from(wrapper.querySelectorAll('[data-user-body] .user-row'));
            const noResults = wrapper.querySelector('[data-no-results]');

            if (input) {
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
            }

            // ---------- pop-ups ----------
            const viewModal = wrapper.querySelector('[data-view-modal]');
            const addModal  = wrapper.querySelector('[data-add-modal]');

            const show = (m) => { m.classList.remove('hidden'); m.classList.add('flex'); };
            const hide = (m) => { m.classList.add('hidden'); m.classList.remove('flex'); };
            const set  = (sel, value) => { viewModal.querySelector(sel).textContent = value || '-'; };

            // eye button
            wrapper.querySelectorAll('[data-view-user]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const name = btn.dataset.name || '';
                    const avatar = viewModal.querySelector('[data-v-avatar]');
                    avatar.textContent = name.charAt(0).toUpperCase();
                    avatar.style.backgroundColor = btn.dataset.color;

                    const badge = viewModal.querySelector('[data-v-status]');
                    badge.className = 'mt-1 inline-flex px-3 py-0.5 rounded-full text-xs font-medium ' + btn.dataset.statusStyle;

                    set('[data-v-name]', name);
                    set('[data-v-status]', btn.dataset.status);
                    set('[data-v-email]', btn.dataset.email);
                    set('[data-v-joined]', btn.dataset.joined);
                    set('[data-v-sessions]', btn.dataset.sessions);
                    set('[data-v-locker]', btn.dataset.locker);

                    show(viewModal);
                });
            });

            // add button
            wrapper.querySelectorAll('[data-open-add]').forEach(function (btn) {
                btn.addEventListener('click', function () { show(addModal); });
            });

            // reopen the add form if validation failed
            if (wrapper.dataset.hasErrors === '1') show(addModal);

            // close buttons, dark area, Esc
            [viewModal, addModal].forEach(function (modal) {
                modal.querySelectorAll('[data-close-modal]').forEach(function (btn) {
                    btn.addEventListener('click', function () { hide(modal); });
                });
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) hide(modal);
                });
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { hide(viewModal); hide(addModal); }
            });
        });
    </script>
    @endpush
@endonce