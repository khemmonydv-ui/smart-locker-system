<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Edit Location</title>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center p-6">

    <div class="bg-white w-[500px] rounded-xl p-6 shadow-lg">

        <!-- Header -->
        <div class="flex justify-center mb-6">
            <h2 class="text-xl font-bold">
                Edit Location
            </h2>
        </div>

        <!-- Form -->
        <form
            action="{{ route('locations.update', $location->id) }}"
            method="POST"
            class="space-y-5">

            @csrf
            @method('PUT')

            <!-- Location Name -->
            <div>
                <label
                    for="name"
                    class="block mb-2 font-semibold">
                    Location Name
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $location->name) }}"
                    class="w-full border border-gray-300 p-3 rounded-[var(--radius-sm)]
                           focus:outline-none focus:ring-2 focus:ring-[var(--button)]"
                    required>
            </div>

            <!-- Address -->
            <div>
                <label
                    for="address"
                    class="block mb-2 font-semibold">
                    Address
                </label>

                <input
                    id="address"
                    type="text"
                    name="address"
                    value="{{ old('address', $location->address) }}"
                    class="w-full border border-gray-300 p-3 rounded-[var(--radius-sm)]
                           focus:outline-none focus:ring-2 focus:ring-[var(--button)]"
                    required>
            </div>

            <!-- Update Button -->
            <button
                type="submit"
                class="mt-5 w-full h-12 rounded-xl bg-brand text-white
                       text-[15px] font-semibold flex items-center
                       justify-center gap-2 hover:brightness-110
                       active:brightness-95 transition">

                Update Location

            </button>

        </form>

    </div>

</body>

</html>
