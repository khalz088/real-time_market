<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-white dark:border-black border border-transparent rounded-md font-semibold text-xs text-white dark:text-black uppercase tracking-widest   transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
