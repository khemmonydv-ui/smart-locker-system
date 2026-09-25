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
<!-- sidebar -->
<x-sidebar />
<div class="main-wrapper">
<!-- navbar -->
<x-navbar
:title="$title ?? 'Locker Usage'"
/>

<!-- page-content -->
<main class="page-content">

    <h1 class="text-2xl font-bold text-gray-900 mb-6">Locker Usage</h1>

    <x-session-table heading="Active Sessions" :sessions="$activeSessions" />
    <x-session-table heading="Completed Sessions" :sessions="$completedSessions" />

</main>
</div>
</div>

@stack('scripts')

</body>

</html>