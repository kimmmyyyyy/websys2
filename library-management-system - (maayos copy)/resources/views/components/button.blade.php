@props(['variant' => 'primary', 'tag' => 'button'])

@php
    $base = 'btn';
    if ($variant === 'primary') $base .= ' btn-primary';
    elseif ($variant === 'outline') $base .= ' btn-outline';
    elseif ($variant === 'ghost') $base .= ' btn-ghost';
@endphp

@if ($tag === 'a' || $attributes->has('href'))
    <a {{ $attributes->merge(['class' => $base]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $base]) }}>
        {{ $slot }}
    </button>
@endif
