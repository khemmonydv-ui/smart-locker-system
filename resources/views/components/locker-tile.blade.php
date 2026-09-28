@props(['name', 'size' => null, 'status' => 'available'])

@php
    $styles = [
        'available' => ['label' => 'Available', 'card' => 'border-green-200 bg-green-50', 'text' => 'text-green-600', 'dot' => 'bg-green-500'],
        'in_use' => ['label' => 'In Use', 'card' => 'border-red-200 bg-red-50', 'text' => 'text-red-500', 'dot' => 'bg-red-500'],
        'maintenance' => ['label' => 'Maintenance', 'card' => 'border-orange-200 bg-orange-50', 'text' => 'text-orange-500', 'dot' => 'bg-orange-500'],
    ];
    $s = $styles[$status] ?? $styles['available'];
@endphp

<div class="rounded-xl border {{ $s['card'] }} p-3 text-center">
    <svg class="w-5 h-5 mx-auto mb-1 {{ $s['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0m-8 4h8a2 2 0 012 2v5a2 2 0 01-2 2H8a2 2 0 01-2-2v-5a2 2 0 012-2z" />
    </svg>
    <p class="font-bold text-gray-900">{{ $name }}</p>
    @if($size)
        <p class="text-xs text-gray-500 capitalize">{{ $size }}</p>
    @endif
    <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium {{ $s['text'] }}">
        <span class="w-1.5 h-1.5 rounded-full {{ $s['dot'] }}"></span>
        {{ $s['label'] }}
    </span>
</div>
