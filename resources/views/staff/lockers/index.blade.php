```blade
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
                :title="$title ?? 'Lockers'" />

            {{-- Content --}}
            <section class="p-5">

                {{-- Table Container --}}
                <div class="bg-white border border-gray-300 rounded-[20px] p-5">

                    <div class="overflow-x-auto">

                        <table class="w-full rounded-[var(--radius-sm)]">

                            {{-- Table Header --}}
                            <thead class="text-start">

                                <tr>

                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2">
                                        Locker
                                    </th>

                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2">
                                        Location
                                    </th>

                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2">
                                        Size
                                    </th>

                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2">
                                        Status
                                    </th>

                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2">
                                        Current User
                                    </th>

                                    <th class="text-start font-extrabold text-[var(--text-secondary)] px-2 py-2">
                                        Last Used
                                    </th>

                                </tr>

                            </thead>


                            {{-- Table Body --}}
                            <tbody>

                                @foreach($lockers as $locker)

                                <tr class="text-start">

                                    {{-- Locker --}}
                                    <td class="text-start text-black font-medium py-4 px-4">
                                        {{ $locker->name }}
                                    </td>


                                    {{-- Location --}}
                                    <td class="text-start text-gray-400 font-medium py-4 px-4">
                                        {{ $locker->location->name }}
                                    </td>


                                    {{-- Size --}}
                                    <td class="text-start text-black font-medium py-4 px-4">
                                        {{ $locker->size }}
                                    </td>


                                    {{-- Status --}}
                                    <td class="text-start text-green-500 font-medium py-4 px-4">
                                        {{ $locker->status }}
                                    </td>


                                    {{-- Current User --}}
                                    <td class="text-start text-red-500 font-medium py-4 px-4">
                                        -
                                    </td>


                                    {{-- Last Used --}}
                                    <td class="text-start text-orange-500 font-medium py-4 px-4">
                                        -
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </section>

            <!-- form add locker. For button is used as component:navbar-button -->

            <div
                id="id01"
                class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">

                <div class="bg-white w-[500px] rounded-xl p-6">

                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-5">

                        <h2 class="text-xl font-bold">
                            Add Locker
                        </h2>

                        <button
                            type="button"
                            onclick="closeAddLocker()"
                            class="text-2xl text-gray-500 hover:text-gray-800">

                            &times;

                        </button>

                    </div>


                    {{-- Form --}}
                    <form
                        method="POST"
                        action="{{ route('lockers.store') }}">

                        @csrf

                        {{-- Locker Name --}}
                        <div class="mb-4">

                            <label class="block mb-2 font-semibold">
                                Locker Name
                            </label>

                            <input
                                type="text"
                                name="locker"
                                placeholder="A301"
                                required
                                class="w-full border border-gray-300 p-3 rounded-lg">

                        </div>


                        {{-- Location --}}
                        <div class="mb-4">

                            <label class="block mb-2 font-semibold">
                                Location
                            </label>

                            <input
                                type="text"
                                name="location"
                                placeholder="Block A - Ground Floor"
                                required
                                class="w-full border border-gray-300 p-3 rounded-lg">

                        </div>


                        {{-- Size --}}
                        <div class="mb-4">

                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1">

                                Size

                            </label>

                            <select
                                name="size"
                                class="bg-gray-200 border border-gray-200 rounded-lg
                                p-3 w-full outline-none focus:ring-2
                                focus:ring-[#FFE8BE] focus:bg-white transition-all">

                                <option value="small">
                                    Small
                                </option>

                                <option value="medium">
                                    Medium
                                </option>

                                <option value="large">
                                    Large
                                </option>

                            </select>

                        </div>


                        {{-- Status --}}
                        <div class="mb-4">

                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1">

                                Status

                            </label>

                            <select
                                name="status"
                                class="bg-gray-200 border border-gray-200 rounded-lg
                                p-3 w-full outline-none focus:ring-2
                                focus:ring-[#FFE8BE] focus:bg-white transition-all">

                                <option value="available">
                                    Available
                                </option>

                                <option value="occupied">
                                    Occupied
                                </option>

                                <option value="maintenance">
                                    Maintenance
                                </option>

                            </select>

                        </div>


                        {{-- Buttons --}}
                        <div class="flex justify-end gap-3 mt-6">

                            <button
                                type="button"
                                onclick="closeAddLocker()"
                                class="px-5 py-2 bg-gray-200 rounded-lg font-semibold">

                                Cancel

                            </button>


                            <button
                                type="submit"
                                class="px-5 py-2 bg-[var(--button)] text-white
                                rounded-lg font-semibold">

                                Save

                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- JavaScript --}}
            <script>

                function openAdd() {

                    const modal = document.getElementById('id01');

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                }


                function closeAddLocker() {

                    const modal = document.getElementById('id01');

                    modal.classList.add('hidden');
                    modal.classList.remove('flex');

                }


                // Close when clicking outside the modal
                window.onclick = function(event) {

                    const modal = document.getElementById('id01');

                    if (event.target === modal) {

                        closeAddLocker();

                    }

                };

            </script>

        </div>

    </div>

</body>

</html>