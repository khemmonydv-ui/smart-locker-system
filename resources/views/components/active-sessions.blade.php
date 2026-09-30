<div class="bg-white border border-gray-300 rounded-[20px] overflow-hidden">

    <!-- Header -->
    <div class="flex justify-between items-center px-5 py-6">

        <h2 class="font-bold text-[14px]">
            Active Sessions ({{ count($sessions) }})
        </h2>

        <a href="{{ route('staff.locker-usage') }}"
            class="text-[var(--text-primary)] font-semibold text-[14px] hover:text-blue-500 hover:underline transition-colors duration-200">
            View All
        </a>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full">

            <tbody>

                @foreach ($sessions as $session)

                <tr class="h-[56px] border-t border-gray-300">

                    <!-- Locker Icon -->
                    <td class="px-5 w-[60px]">

                        <div class="w-10 h-10 rounded-md bg-indigo-100 flex items-center justify-center">

                            <i class="fa-solid fa-lock text-blue-500"></i>

                        </div>

                    </td>

                    <!-- User + Location -->
                    <td class="px-2">

                        <p class="text-[14px]">
                            {{ $session['name'] }}
                        </p>

                        <p class="text-gray-400 text-[14px]">
                            {{ $session['location'] }}
                        </p>

                    </td>

                    <!-- Time -->
                    <td class="px-5 text-right text-[14px]">
                        {{ $session['time'] }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>