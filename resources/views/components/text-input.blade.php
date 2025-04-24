@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-black border   rounded-md shadow-sm']) }}>
