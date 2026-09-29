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
            <x-navbar-button
                :title="$title ?? 'Locations'" />

            <!-- {{-- Content --}} -->
            <section class="p-5">

                <!-- {{--Table Container table locations--}} -->
                <div class="bg-white border border-gray-300 rounded-[20px] p-5">

                    <div class="overflow-x-auto">

                        <table class="w-full rounded-[var(--radius-sm)]">
                            <thead class="text-start rounded-[var(--radius-sm)] ">
                                <tr>
                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2 rounded-[var(--radius-sm)]">Location</th>
                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2 rounded-[var(--radius-sm)]">Address</th>
                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2 rounded-[var(--radius-sm)]">Total</th>
                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2 rounded-[var(--radius-sm)]">Available</th>
                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2 rounded-[var(--radius-sm)]">In Use</th>
                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2 rounded-[var(--radius-sm)]">Main.</th>
                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2 rounded-[var(--radius-sm)]">Status</th>
                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2 rounded-[var(--radius-sm)]">Action</th>
                                </tr>
                            </thead>

                            <tbody class=" ">
                                @foreach($locations as $location)
                                <tr class="text-start">
                                    <td class="text-start text-black font-medium py-4 px-4">{{ $location->name}}</td>
                                    <td class="text-start text-gray-400 font-medium py-4 px-4">{{$location->address}}</td>
                                    <td class="text-start text-black-300 font-medium py-4 px-4">{{ $location->lockers->count() }}</td>
                                    <td class="text-start text-green-500 font-medium py-4 px-4"> {{ $location->lockers->where('status', 'available')->count() }}</td>
                                    <td class="text-start text-red-500 font-medium py-4 px-4"> {{ $location->lockers->where('status', 'in_use')->count() }}</td>
                                    <td class="text-start text-orange-500 font-medium py-4 px-4"> {{ $location->lockers->where('status', 'maintenance')->count() }}</td>
                                    <td class="text-start py-5 px-5">
                                        <span class=" items-center gap-2 px-3 py-1.5 bg-green-100 text-green-700 text-sm font-medium rounded-[var(--radius-sm)]">
                                            <span class="w-2 h-2 bg-green-500 rounded-full"> {{ $location->status }}</span>
                                            Open
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">

                                            <!-- Edit -->
                                            <a href="{{ route('locations.edit', $location->id) }}">
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('locations.destroy', $location->id) }}"
                                                method="POST"
                                                style="display:inline;">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </section>

            <!-- form add location. For button is used as component:navbar-button -->
            <div
                id="id01"
                class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
                <div class="bg-white w-[500px] rounded-xl p-6">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-5">

                        <h2 class="text-xl font-bold">
                            Add Location
                        </h2>

                        <button
                            type="button"
                            onclick="closeAddLocation()"
                            class="text-2xl text-gray-500 hover:text-gray-800">
                            &times;
                        </button>

                    </div>

                    <!-- Form -->
                    <form
                        method="POST"
                        action="{{ route('locations.store') }}">
                        @csrf

                        <!-- Location Name -->
                        <div class="mb-4">
                            <label class="block mb-2 font-semibold">
                                Location Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                placeholder="Central Library"
                                required
                                class="w-full border border-gray-300 p-3 rounded-lg">
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label class="block mb-2 font-semibold">
                                Address
                            </label>

                            <input
                                type="text"
                                name="address"
                                placeholder="123 Main Street"
                                required
                                class="w-full border border-gray-300 p-3 rounded-lg">
                        </div>

                        <!-- Opening Hours -->
                        <div class="mb-4">
                            <label class="block mb-2 font-semibold">
                                Opening Hours
                            </label>

                            <input
                                type="text"
                                name="opening_hours"
                                placeholder="Mon-Fri 8:00-20:00"
                                required
                                class="w-full border border-gray-300 p-3 rounded-lg">
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end gap-3 mt-6">

                            <button
                                type="button"
                                onclick="closeAddLocation()"
                                class="px-5 py-2 bg-gray-200 rounded-lg font-semibold">
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="px-5 py-2 bg-[var(--button)] text-white rounded-lg font-semibold">
                                Save
                            </button>

                        </div>

                    </form>

                </div>
            </div>

            <script>
                function openAdd() {
                    const modal = document.getElementById('id01');

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeAddLocation() {
                    const modal = document.getElementById('id01');

                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }

                // Close when clicking outside the modal
                window.onclick = function(event) {
                    const modal = document.getElementById('id01');

                    if (event.target === modal) {
                        closeAddLocation();
                    }
                };
            </script>

        </div>

    </div>

</body>

</html>