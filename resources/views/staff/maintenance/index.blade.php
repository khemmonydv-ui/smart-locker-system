<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'Smart Locker System' }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="app-layout">

    {{-- Sidebar --}}
    <x-sidebar />

    <div class="main-wrapper">

        {{-- Navbar --}}
        <x-navbar
            :title="$title ?? 'Maintenance'"
            :subtitle="$subtitle ?? 'Track and resolve reported locker issues'"
        />

        {{-- Page Content --}}
        <main class="page-content">

            @if (session('success'))
                <div class="badge success" style="margin-bottom: 16px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="content-card recent-card">

                <div class="card-header">
                    <div>
                        <h3>Maintenance Reports</h3>
                        <p>Issues reported on lockers across all locations</p>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>Locker</th>
                                <th>Location</th>
                                <th>Problem</th>
                                <th>Reported</th>
                                <th>Status</th>
                                <th>Assigned</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $statusLabels = [
                                    'pending'     => 'Pending',
                                    'in_progress' => 'In Progress',
                                    'resolved'    => 'Resolved',
                                ];
                                // Reuses the existing .badge.success / .badge.pending
                                // classes already defined in app.css.
                                $statusBadge = [
                                    'pending'     => 'pending',
                                    'in_progress' => 'pending',
                                    'resolved'    => 'success',
                                ];
                            @endphp

                            @forelse ($reports as $report)
                                <tr>
                                    <td>
                                        <div class="table-user">
                                            @if ($report->is_urgent)
                                                <i class="fa-solid fa-triangle-exclamation" style="color: #dc2626;"></i>
                                            @endif
                                            <span>{{ $report->locker_code }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $report->location }}</td>
                                    <td>{{ $report->problem }}</td>
                                    <td>{{ $report->reported_at }}</td>
                                    <td>
                                        <span class="badge {{ $statusBadge[$report->status] ?? 'pending' }}">
                                            {{ $statusLabels[$report->status] ?? ucfirst($report->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $report->assigned_to ?? '—' }}</td>
                                    <td>
                                        @if ($report->status !== 'resolved')
                                            <form action="{{ route('maintenance.resolve', $report->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" title="Mark resolved" style="background:none; border:none; cursor:pointer; color:#16a34a; font-size:16px;">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </button>
                                            </form>
                                        @else
                                            <i class="fa-solid fa-circle-check" style="color:#16a34a; font-size:16px;"></i>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; color: var(--text-light); padding: 30px;">
                                        No maintenance reports yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>
</div>

</body>
</html>