@props(['value', 'label', 'color' => 'green'])

@php
    $colors = [
        'green' => ['bg' => 'bg-green-50', 'text' => 'text-green-600'],
        'red' => ['bg' => 'bg-red-50', 'text' => 'text-red-500'],
        'orange' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-500'],
    ];
    $c = $colors[$color] ?? $colors['green'];
@endphp

<div class="flex-1 rounded-xl {{ $c['bg'] }} px-4 py-4 text-center">
    <p class="text-2xl font-bold {{ $c['text'] }}">{{ $value }}</p>
    <p class="text-xs {{ $c['text'] }} mt-1">{{ $label }}</p>
</div>
