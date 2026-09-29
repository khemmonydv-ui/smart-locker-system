<div class="bg-white border border-gray-300 rounded-xl h-[100px] p-4 flex items-center justify-between">

    <div>
        <p class="text-gray-400 text-[16px]">
            {{ $title }}
        </p>

        <p class="text-[34px] font-bold mt-1">
            {{ $value }}
        </p>
    </div>

    <div class="w-10 h-10 {{ $iconBg }} rounded-md flex items-center justify-center">

        <span class="{{ $iconColor }}">
            {!! $icon !!}
        </span>

    </div>

</div>