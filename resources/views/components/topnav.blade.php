<div
    x-data="{ isMobileMenuOpen: false }"
    class="px-4 py-5 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 border-b border-[#385c35] bg-[#f5f1e3]"
>
    <div class="relative flex items-center justify-between">
        <!-- Logo -->
        <a href="/" aria-label="Company" title="Company" class="inline-flex items-center">
            <x-application-logo2/>
        </a>

        <!-- Desktop Menu -->
        <ul class="flex items-center hidden space-x-8 lg:flex">
            <li><a href="/"
                   class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-[#385c35]">Home</a>
            </li>
            <li><a href="{{route('tip.view')}}"
                   class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-[#385c35]">Tips</a>
            </li>


            @auth
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-[#385c35]">
                        Dashboard
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-[#385c35]">
                        Sign in
                    </a>
                </li>
            @endauth
        </ul>

        <!-- Mobile Hamburger -->
        <div class="lg:hidden">
            <button @click="isMobileMenuOpen = !isMobileMenuOpen"
                    aria-label="Toggle Menu"
                    class="p-2 transition duration-200 rounded focus:outline-none focus:shadow-outline hover:bg-gray-100">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': isMobileMenuOpen, 'inline': !isMobileMenuOpen}"
                          class="inline"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'inline': isMobileMenuOpen, 'hidden': !isMobileMenuOpen}"
                          class="hidden"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div x-show="isMobileMenuOpen" @click.away="isMobileMenuOpen = false" class="lg:hidden mt-3">
        <div class="p-5 border rounded shadow-sm bg-white">
            <ul class="space-y-4">
                <li><a href="/" class="block font-medium tracking-wide text-gray-700 hover:text-[#385c35]">Home</a>
                </li>
                <li><a href="{{route('tip.view')}}"
                       class="block font-medium tracking-wide text-gray-700 hover:text-[#385c35]">Tips</a>
                </li>

                @auth
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="block w-full text-center h-12 px-6 font-medium tracking-wide text-white bg-[#385c35] rounded shadow-md">
                            Dashboard
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}"
                           class="block w-full text-center h-12 px-6 font-medium tracking-wide text-white bg-[#385c35] rounded shadow-md">
                            Sign in
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
