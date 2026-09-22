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
                :title="$title ?? 'Dashboard'"
                :subtitle="$subtitle ?? 'Overview of your smart locker system'"
            />

            {{-- Page Content --}}
            <main class="page-content">

                {{ $slot }}

            </main>

        </div>

    </div>

</body>

</html>
