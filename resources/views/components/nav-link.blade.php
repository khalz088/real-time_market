@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center rounded-sm gap-2 bg-black/10 px-2 py-1.5 text-sm font-medium text-neutral-900 underline-offset-2 focus-visible:underline focus:outline-hidden dark:bg-white/10 dark:text-white'
            : 'flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
