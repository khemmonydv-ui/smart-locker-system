@props(['active' => false])

<button
    type="button"
    {{ $attributes->merge([
        'class' => 'px-4 py-2 rounded-full text-sm font-medium transition whitespace-nowrap '
            . ($active ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-400 hover:bg-gray-200'),
    ]) }}
>
    {{ $slot }}
</button>
