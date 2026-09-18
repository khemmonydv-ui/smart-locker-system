@props([
    'title' => 'Dashboard',
    'subtitle' => 'Overview of your Smart Locker System',
])

<header class="flex h-[76px] shrink-0 items-center justify-between border-b border-gray-200 bg-white px-6">

    {{-- LEFT: PAGE TITLE --}}
    <div>
        <h1 class="font-secondary text-2xl font-bold text-gray-800">
            {{ $title }}
        </h1>

        <p class="font-main text-sm text-gray-500">
            {{ $subtitle }}
        </p>
    </div>


    {{-- RIGHT: NOTIFICATION + ADMIN --}}
    <div class="flex items-center gap-6">

        {{-- Notification --}}
        <button
            type="button"
            class="relative flex h-10 w-10 items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100"
        >
            <i class="fa-solid fa-bell text-lg"></i>

            <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-[#9D0035]"></span>
        </button>


        {{-- Admin --}}
        <div class="flex items-center gap-3">

            <div class="text-right">
                <p class="font-main text-sm font-semibold text-gray-800">
                    Admin
                </p>

                <p class="font-main text-xs text-gray-500">
                    Administrator
                </p>
            </div>


            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#2F32E4]">

                <span class="font-secondary text-lg font-bold text-white">
                    A
                </span>

            </div>

        </div>

    </div>

</header>