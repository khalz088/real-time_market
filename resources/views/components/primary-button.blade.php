<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white  border border-[#385c35] rounded-md font-semibold text-xs text-[#385c35]  uppercase tracking-widest   transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
