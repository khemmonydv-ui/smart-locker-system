@props([
    'heading',        // e.g. "Active Sessions"
    'sessions',       // collection of objects: locker, user, location, start_time, duration, status
])

@php
    $statusStyles = [
        'active'    => 'bg-emerald-50 text-emerald-600',
        'completed' => 'bg-indigo-100 text-indigo-600',
        'cancelled' => 'bg-rose-50 text-rose-600',
    ];
@endphp

<div class="mb-8">
    <h2 class="text-base font-semibold text-gray-800 mb-3">
        {{ $heading }} ({{ $sessions->count() }})
    </h2>

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white">
        <table class="w-full text-sm table-fixed">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs font-medium border-b border-gray-200">
                    <th class="text-left px-5 py-3">Locker</th>
                    <th class="text-left px-5 py-3">User</th>
                    <th class="text-left px-5 py-3">Location</th>
                    <th class="text-left px-5 py-3">Start Time</th>
                    <th class="text-left px-5 py-3">Duration</th>
                    <th class="text-left px-5 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($sessions as $session)
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-5 py-3.5 text-gray-400 font-medium">{{ $session->locker }}</td>
                        <td class="px-5 py-3.5 text-gray-800">{{ $session->user }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $session->location }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $session->start_time }}</td>
                        <td class="px-5 py-3.5 text-gray-600">{{ $session->duration }}</td>
                        <td class="px-5 py-3.5">
                            @php
                                $style = $statusStyles[strtolower($session->status)] ?? 'bg-gray-100 text-gray-500';
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $style }}">
                                {{ ucfirst($session->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-gray-400">No sessions to show.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>