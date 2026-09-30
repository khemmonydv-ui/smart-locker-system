<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">

    {{-- Header --}}
    <header class="flex items-center gap-4 px-6 sm:px-12 py-5 border-b">
        <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-800">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">Profile</h1>
    </header>

    <main class="max-w-[800px] mx-auto px-4 py-8">

        {{-- Avatar --}}
        <div class="flex flex-col items-center mb-6">
            <div class="w-28 h-28 rounded-full bg-gray-200"></div>
            <h2 class="text-xl font-semibold mt-4">Alex John</h2>
            <span class="mt-1 text-sm text-green-700 bg-green-100 px-3 py-0.5 rounded-full">Active</span>
        </div>

        {{-- Info card --}}
        <div class="border  rounded-2xl p-4 space-y-4 mb-4">
            <div class="flex items-start gap-3">
                <span class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-500">Full Name</p>
                    <p class="font-semibold">Alex Johnson</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-500">Email</p>
                    <p class="font-semibold">alex.johnson@email.com</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-500">Phone</p>
                    <p class="font-semibold">+1 555-1001</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-500">Member since</p>
                    <p class="font-semibold">March 2025</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>
                    </svg>
                </span>
                <div>
                    <p class="text-xs text-gray-500">Total sessions</p>
                    <p class="font-semibold">14</p>
                </div>
            </div>
        </div>

        {{-- Action list --}}
        <div class="border rounded-2xl divide-y">
            <a href="#" class="flex items-center gap-3 px-4 py-4 hover:bg-gray-50">
                <span class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z"/>
                    </svg>
                </span>
                <span class="font-medium">Edit Profile</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-4 hover:bg-gray-50">
                <span class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <span class="font-medium">Change Password</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-4 hover:bg-gray-50">
                <span class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                </span>
                <span class="font-medium">Usage History</span>
            </a>

            <form method="POST" action="#" class="flex">
                @csrf
                <button class="flex items-center gap-3 px-4 py-4 hover:bg-gray-50 w-full text-left text-red-600">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-red-50 text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/>
                        </svg>
                    </span>
                    <span class="font-semibold">Logout</span>
                </button>
            </form>
        </div>

    </main>

</body>
</html>