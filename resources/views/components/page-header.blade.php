@props(['title', 'back' => null])

<div class="flex items-center gap-4 px-4 py-4 border-b border-gray-100">
    <a href="{{ $back ?? url()->previous() }}" class="text-gray-700">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </a>
    <h1 class="text-base font-semibold text-gray-900">{{ $title }}</h1>
</div>
