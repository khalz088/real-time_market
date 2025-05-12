@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'flex items-center rounded-sm gap-2  px-2 py-1.5 text-sm font-medium text-white underline-offset-2 focus-visible:underline focus:outline-hidden bg-[#385c35]'
                : 'flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-[#385c35] underline-offset-2 focus-visible:underline focus:outline-hidden';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
