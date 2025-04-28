<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />



        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div x-data="{ sidebarIsOpen: false }" class="relative flex w-full flex-col md:flex-row">



                <!-- dark overlay for when the sidebar is open on smaller screens  -->
                <div x-cloak x-show="sidebarIsOpen" class="fixed inset-0 z-20 bg-neutral-950/10 backdrop-blur-xs md:hidden" aria-hidden="true" x-on:click="sidebarIsOpen = false" x-transition.opacity ></div>

                <nav x-cloak class="fixed left-0 z-30 flex h-svh w-60 shrink-0 flex-col border-r border-neutral-300 bg-neutral-50 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:border-neutral-700 dark:bg-neutral-900" x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">
                    <!-- logo  -->
                    <a href="/" class="ml-2 w-fit text-2xl font-bold text-neutral-900 dark:text-white">
                        <x-application-logo  />
                    </a>



                    <!-- sidebar links  -->
                    <div class="flex flex-col gap-2 overflow-y-auto pb-6 pt-6">



                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                    <path d="M15.5 2A1.5 1.5 0 0 0 14 3.5v13a1.5 1.5 0 0 0 1.5 1.5h1a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 16.5 2h-1ZM9.5 6A1.5 1.5 0 0 0 8 7.5v9A1.5 1.5 0 0 0 9.5 18h1a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 10.5 6h-1ZM3.5 10A1.5 1.5 0 0 0 2 11.5v5A1.5 1.5 0 0 0 3.5 18h1A1.5 1.5 0 0 0 6 16.5v-5A1.5 1.5 0 0 0 4.5 10h-1Z"/>
                                </svg>
                               <p class="pl-3">{{ __('Dashboard') }}</p>
                            </x-nav-link>
                        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                            </svg>
                            <p class="pl-3">{{ __('Profile') }}</p>
                        </x-nav-link>
                        <x-nav-link :href="route('category.index')" :active="request()->routeIs('category.index')">
                            <x-heroicon-o-plus-circle class="w-5 h-5 "/>
                            <p class="pl-3">{{ __('category') }}</p>
                        </x-nav-link>
                        <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                            <x-heroicon-c-user-circle class="w-5 h-5 "/>
                            <p class="pl-3">{{ __('users') }}</p>
                        </x-nav-link>

                    </div>
                </nav>

                <!-- top navbar & main content  -->
                <div class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
                    <!-- top navbar  -->
                    <nav class="sticky top-0 z-10 flex items-center justify-between border-b border-neutral-300 bg-neutral-50 px-4 py-2 dark:border-neutral-700 dark:bg-neutral-900" aria-label="top navibation bar">

                        <!-- sidebar toggle button for small screens  -->
                        <button type="button" class="md:hidden inline-block text-neutral-600 dark:text-neutral-300" x-on:click="sidebarIsOpen = true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5" aria-hidden="true">
                                <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2z"/>
                            </svg>
                            <span class="sr-only">sidebar toggle</span>
                        </button>

                        <!-- breadcrumbs  -->
                        <nav class="hidden md:inline-block text-sm font-medium text-neutral-600 dark:text-neutral-300" aria-label="breadcrumb">
                            @php
                                $segments = request()->segments();
                                $url = url('/');
                            @endphp

                            <ol class="flex flex-wrap items-center gap-1">
                                {{-- Home always first --}}
                                <li class="flex items-center gap-1">
                                    <a href="{{ url('/') }}" class="hover:text-neutral-900 dark:hover:text-white">Home</a>
                                    @if(count($segments))
                                        <x-heroicon-o-chevron-right class="w-4 h-4"/>
                                    @endif
                                </li>

                                @foreach($segments as $i => $segment)
                                    @php
                                        // Build up the URL to this segment
                                        $url .= '/'.$segment;

                                        // Turn “user-profile” → “User Profile”
                                        $label = str()->of($segment)
                                                    ->replace(['-', '_'], ' ')
                                                    ->title();
                                    @endphp

                                    {{-- If it’s the last segment, no link & bold --}}
                                    @if($loop->last)
                                        <li class="flex items-center gap-1 font-bold text-neutral-900 dark:text-white" aria-current="page">
                                            {{ $label }}
                                        </li>
                                    @else
                                        <li class="flex items-center gap-1">
                                            <a href="{{ $url }}" class="hover:text-neutral-900 dark:hover:text-white">
                                                {{ $label }}
                                            </a>
                                            <x-heroicon-o-chevron-right class="w-4 h-4"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>

                        </nav>


                        <!-- Profile Menu  -->
                        <div x-data="{ userDropdownIsOpen: false }" class="relative" x-on:keydown.esc.window="userDropdownIsOpen = false">
                            <button type="button" class="flex w-full items-center rounded-sm gap-2 p-2 text-left text-neutral-600 hover:bg-black/5 hover:text-neutral-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white dark:focus-visible:outline-white" x-bind:class="userDropdownIsOpen ? 'bg-black/10 dark:bg-white/10' : ''" aria-haspopup="true" x-on:click="userDropdownIsOpen = ! userDropdownIsOpen" x-bind:aria-expanded="userDropdownIsOpen">
                                <x-heroicon-c-user class="h-10 w-10 dark:text-white text-black"/>
                                <div class="hidden md:flex flex-col">
                                    <span class="text-sm font-bold text-neutral-900 dark:text-white">{{auth()->user()->name}}</span>
                                    <span class="text-xs" aria-hidden="true">{{auth()->user()->email}}</span>
                                    <span class="sr-only">profile settings</span>
                                </div>
                            </button>

                            <!-- menu -->
                            <div x-cloak x-show="userDropdownIsOpen" class="absolute top-14 right-0 z-20 h-fit w-48 border divide-y divide-neutral-300 border-neutral-300 bg-white dark:divide-neutral-700 dark:border-neutral-700 dark:bg-neutral-950 rounded-sm" role="menu" x-on:click.outside="userDropdownIsOpen = false" x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition="" x-trap="userDropdownIsOpen">

                                <div class="flex flex-col py-1.5">
                                    <a
                                        href="{{route('profile.edit')}}" class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white" role="menuitem">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                            <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                                        </svg>
                                        <span>Profile</span>
                                    </a>
                                </div>

                                <div class="flex flex-col py-1.5">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a :href="route('logout')"
                                           class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-none dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white"

                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd"/>
                                                <path fill-rule="evenodd" d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Sign Out</span>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <!-- main content  -->
                    <div id="main-content" class="p-4">
                        <div class="overflow-y-auto">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>
