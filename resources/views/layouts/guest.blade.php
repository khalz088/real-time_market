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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen pt-6   sm:pt-0 bg-gray-100 dark:bg-black">

            <div class="container mx-auto  py-20">
            <div class="grid grid-cols-1 sm:grid-cols-2  ">
                <div class="hidden sm:flex ml-10">
                    <!-- Date Card Component -->
                    <div class="w-96 h-[80vh] bg-black rounded-3xl overflow-hidden shadow-lg flex relative border dark:border-white border-black">
                        <!-- Left section with date -->
                        <div class="w-1/2 p-6 flex flex-col">
                            <div class="text-white font-bold text-2xl mb-1">
                                {{ date('D') }}
                            </div>
                            <div class="text-white font-semibold text-4xl">
                                {{ date('jS') }}
                            </div>

                            <div class="mt-auto mb-4">
                                <div class="text-xs text-white font-medium font-semibold">Soko La Mazao</div>
                                <div class="text-xs text-white font-medium">Hali ya hewa jhasdakjs dajsdyhjkasyd kjasdh as</div>
                            </div>
                            <div class="mt-auto">
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="text-xs font-medium text-white">Mwanza, Tanzania</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right section with sun and details -->
                        <div class="w-1/2 bg-white p-6 flex flex-col relative overflow-hidden">
                            <!-- Orange sun circle (half visible only) -->
                            <div class="pr-3 absolute -left-20 top-24 w-[43vh] h-[43vh] rounded-full bg-gradient-to-br from-orange-300 to-orange-500 opacity-90"></div>
                        </div>
                    </div>


                </div>
                <div class="sm:justify-center  flex flex-col   items-center ">
                <div>
                    <a href="/">
                        <x-application-logo  />
                    </a>
                </div>
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white  shadow-md overflow-hidden sm:rounded-lg border  border-black ">
                    {{ $slot }}
                </div>
                </div>
            </div>

            </div>


        </div>
    </body>
</html>
