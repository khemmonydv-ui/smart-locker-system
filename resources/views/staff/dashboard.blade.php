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
                :subtitle="$subtitle ?? 'Overview of your smart locker system'" />

            {{-- Page Content --}}
            <main class="page-content">
                <div class="p-5">

                    <!-- STAT CARDS -->

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">

                        <x-card
                            title="Locations"
                            value="5"
                            icon='<i class="fa-solid fa-location-crosshairs"></i>'
                            icon-bg="bg-gray-100"
                            icon-color="text-gray-800" />

                        <x-card
                            title="Total Lockers"
                            value="240"
                            icon='<i class="fa-solid fa-lock"></i>'
                            icon-bg="bg-indigo-100"
                            icon-color="text-blue-500" />

                        <x-card
                            title="Available"
                            value="146"
                            icon='<i class="fa-solid fa-check"></i>'
                            icon-bg="bg-green-50"
                            icon-color="text-green-500" />

                        <x-card
                            title="In Use"
                            value="82"
                            icon='<i class="fa-solid fa-arrow-trend-down"></i>'
                            icon-bg="bg-gray-100"
                            icon-color="text-gray-500" />

                        <x-card
                            title="Maintenance"
                            value="12"
                            icon='<i class="fa-solid fa-screwdriver-wrench"></i>'
                            icon-bg="bg-gray-100"
                            icon-color="text-red-500" />

                    </div>

                    <!--  BOTTOM SECTION-->
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 mt-9">

                        <!--ACTIVE SESSIONS  -->
                        <x-active-sessions
                            :sessions="[
                            [
                            'name' => 'Alex Johnson',
                            'location' => 'Riverside Sports Center · A03',
                            'time' => '01:24',
                            ],
                            [
                            'name' => 'Maria Santos',
                            'location' => 'Central Library · B01',
                            'time' => '00:59',
                            ],
                            [
                            'name' => 'David Kim',
                            'location' => 'Central Library · B04',
                            'time' => '02:44',
                            ],
                            [
                            'name' => 'Sarah Chen',
                            'location' => 'Westfield Shopping Centre · A02',
                            'time' => '05:25',
                            ],
                            
                        ]" />

                        <!--  MAINTENANCE ALERTS  -->
                        <x-maintenance
                            :maintenances="[
                            [
                            'location' => 'A05 · Central Library',
                            'problem' => 'Door latch broken — will not lock properly',
                            'status' => 'In progress',
                            ],
                            [
                            'location' => 'B06 · Central Library',
                            'problem' => 'Digital panel unresponsive',
                            'status' => 'pending',
                            ],
                            [
                            'location' => 'B01 · Westfield Shopping Centre',
                            'problem' => 'Lock mechanism jammed',
                            'status' => 'pending',
                            ],
                            [
                            'location' => 'B02 · Riverside Sports Center',
                            'problem' => 'Hinge damaged, door alignment off',
                            'status' => 'In progress',
                            ],
                            
                        ]" />
                    </div>

            </main>

        </div>

    </div>

</body>

</html>