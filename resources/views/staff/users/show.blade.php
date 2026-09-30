<x-app-layout>

    <div class="p-6">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                User Information
            </h1>

            <p class="text-gray-500 mt-1">
                Details about this user
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

            <div class="flex items-center gap-4 mb-6">

                <div class="w-14 h-14 rounded-full bg-indigo-500
                            flex items-center justify-center
                            text-white text-xl font-semibold">

                    {{ strtoupper(substr($user->name, 0, 1)) }}

                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $user->name }}
                    </h2>

                    <p class="text-gray-500">
                        User ID: {{ $user->id }}
                    </p>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="font-medium text-gray-800">
                        {{ $user->name }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-800">
                        {{ $user->email }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-medium text-gray-800">
                        {{ $user->phone ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Status</p>

                    <span class="inline-flex px-3 py-1 rounded-full text-sm
                        {{ $user->status === 'active'
                            ? 'bg-emerald-50 text-emerald-600'
                            : 'bg-gray-100 text-gray-500' }}">

                        {{ ucfirst($user->status) }}

                    </span>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>