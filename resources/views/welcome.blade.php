<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <style>
        body {
            background-color: #f5f1e3;
        }

        .agrilink-green {
            color: #385c35;
        }

        .agrilink-bg {
            background-color: #385c35;
        }

        .agrilink-border {
            border-color: #385c35;
        }

        .agrilink-card {
            background-color: #faf7ee;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans">
<div class="sticky top-0 z-50">
    <x-topnav/>
</div>
<x-hero/>


<div
    class="flex flex-col lg:flex-row gap-5 px-4 py-20 mx-auto  md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-10">
    <!-- Product Carousel -->
    <div x-data="{
    currentIndex: 0,
    products: [],
    rawProducts: {{ Js::from($products->items()) }}, // Pass raw product array from server
    interval: null,
    isMobile: window.innerWidth < 768,
    init() {
        // Chunk products client-side based on isMobile
        this.products = this.chunkArray(this.rawProducts, this.isMobile ? 1 : 2);
        this.startAutoSlide();
        this.$watch('currentIndex', () => {
            if (this.currentIndex >= this.products.length) this.currentIndex = 0;
        });

        // Update on window resize
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 1024;
            this.products = this.chunkArray(this.rawProducts, this.isMobile ? 1 : 2);
        });
    },
    chunkArray(array, size) {
        const result = [];
        for (let i = 0; i < array.length; i += size) {
            result.push(array.slice(i, i + size));
        }
        return result;
    },
    startAutoSlide() {
        this.interval = setInterval(() => this.next(), 2000);
    },
    stopAutoSlide() {
        clearInterval(this.interval);
    },
    next() {
        this.currentIndex = (this.currentIndex + 1) % this.products.length;
    },
    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.products.length) % this.products.length;
    }
}"
         class="relative w-full lg:w-4/6"
         @mouseenter="stopAutoSlide()"
         @mouseleave="startAutoSlide()">

        <h2 class="text-xl font-semibold mb-4 text-[#385c35] text-center">Bidhaa Zinazopendwa</h2>

        <div class="relative overflow-hidden h-44">
            <template x-for="(group, groupIndex) in products" :key="groupIndex">
                <div
                    x-show="currentIndex === groupIndex"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-full"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform -translate-x-full"
                    class="absolute top-0 left-0 w-full grid grid-cols-1 md:grid-cols-2 gap-4"
                >
                    <template x-for="product in group" :key="product.id">
                        <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                            <h3 class="font-medium text-lg text-gray-800" x-text="product.name"></h3>
                            <p class="text-gray-600" x-text="product.category.name"></p>

                            <template x-if="product.market_price && product.market_price.length > 0">
                                <div class="mt-2 space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500">Bei ya Rejareja:</span>
                                        <span class="font-medium text-gray-800"
                                              x-text="'TZS ' + product.market_price[0].retail_price.toLocaleString('en-US')">
                                    </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500">Bei ya Jumla:</span>
                                        <span class="font-medium text-gray-800"
                                              x-text="'TZS ' + product.market_price[0].wholesale_price.toLocaleString('en-US')">
                                    </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500">Mwenendo:</span>
                                        <span class="flex items-center">
                                    <template x-if="product.market_price[0].price_trend === 'up'">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-5 w-5 text-green-600" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </template>
                                    <template x-if="product.market_price[0].price_trend === 'down'">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586l-4.293-4.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </template>
                                    <template x-if="product.market_price[0].price_trend === 'stable'">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </template>
                                    <span x-text="product.market_price[0].price_change_percent + '%'"
                                          class="ml-1"
                                          :class="{
                                              'text-green-600': product.market_price[0].price_change_percent > 0,
                                              'text-red-600': product.market_price[0].price_change_percent < 0,
                                              'text-gray-500': product.market_price[0].price_change_percent === 0
                                          }">
                                    </span>
                                </span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </template>
        </div>
        <!-- Indicators -->
        <div class="flex justify-center mt-1 space-x-2">
            <template x-for="(group, index) in products" :key="index">
                <button
                    @click="currentIndex = index"
                    class="w-3 h-3 rounded-full"
                    :class="currentIndex === index ? 'bg-blue-600' : 'bg-gray-300'"
                ></button>
            </template>
        </div>
    </div>


    <div class="border-2 agrilink-border rounded lg:w-2/6 w-full p-4">
        <h3 class="text-lg font-semibold mb-3">Utabiri wa Hali ya Hewa</h3>

        @php
            // Pata data ya hali ya hewa kutoka API
            $weatherResponse = Http::get('https://api.weatherapi.com/v1/forecast.json', [
                'key' => env('WEATHER_API_KEY'),
                'q' => 'mwanza,Tanzania',
                'days' => 3,
            ]);

            $weatherData = $weatherResponse->json();
        @endphp

        @if(isset($weatherData['error']))
            <p class="text-red-500">Hitilafu ya kupata hali ya hewa: {{ $weatherData['error']['message'] }}</p>
        @else
            <!-- Hali ya Hewa ya Sasa -->
            <div class="mb-4 pb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="mr-3">
                        <img src="{{ 'https:' . $weatherData['current']['condition']['icon'] }}"
                             alt="{{ $weatherData['current']['condition']['text'] }}" class="w-12 h-12">
                    </div>
                    <div>
                        <p class="font-medium">{{ $weatherData['current']['condition']['text'] }}</p>
                        <p class="text-2xl font-bold">{{ $weatherData['current']['temp_c'] }}°C</p>
                        <p class="text-sm text-gray-600">Inahisi kama {{ $weatherData['current']['feelslike_c'] }}°C</p>
                    </div>
                </div>
            </div>

            <!-- Utabiri wa Siku 3 -->
            <div class="space-y-4">
                @foreach($weatherData['forecast']['forecastday'] as $day)
                    <div class="flex justify-between items-center">
                        <div class="w-1/3">
                            <p class="font-medium">
                                @if($loop->first)
                                    Leo
                                @else
                                    @php
                                        $siku = \Carbon\Carbon::parse($day['date'])->format('l');
                                        // Badilisha siku kwa Kiswahili
                                        $sikuKiswahili = [
                                            'Monday' => 'Jumatatu',
                                            'Tuesday' => 'Jumanne',
                                            'Wednesday' => 'Jumatano',
                                            'Thursday' => 'Alhamisi',
                                            'Friday' => 'Ijumaa',
                                            'Saturday' => 'Jumamosi',
                                            'Sunday' => 'Jumapili'
                                        ][$siku];
                                    @endphp
                                    {{ $sikuKiswahili }}
                                @endif
                            </p>
                            <p class="text-sm text-gray-600">
                                @php
                                    $mwezi = \Carbon\Carbon::parse($day['date'])->format('M');
                                    // Badilisha miezi kwa Kiswahili
                                    $mieziKiswahili = [
                                        'Jan' => 'Jan',
                                        'Feb' => 'Feb',
                                        'Mar' => 'Mac',
                                        'Apr' => 'Apr',
                                        'May' => 'Mei',
                                        'Jun' => 'Jun',
                                        'Jul' => 'Jul',
                                        'Aug' => 'Ago',
                                        'Sep' => 'Sep',
                                        'Oct' => 'Okt',
                                        'Nov' => 'Nov',
                                        'Dec' => 'Des'
                                    ][$mwezi];
                                @endphp
                                {{ $mieziKiswahili }} {{ \Carbon\Carbon::parse($day['date'])->format('j') }}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <img src="{{ 'https:' . $day['day']['condition']['icon'] }}"
                                 alt="{{ $day['day']['condition']['text'] }}" class="w-8 h-8 mr-2">
                            <span>
                            @php
                                // Tafsiri hali ya hewa kwa Kiswahili
                                $haliHewa = [
                                    'Sunny' => 'Jua kali',
                                    'Partly cloudy' => 'Wingu kidogo',
                                    'Cloudy' => 'Mawingu',
                                    'Overcast' => 'Mawingu mengi',
                                    'Mist' => 'Ukungu',
                                    'Patchy rain possible' => 'Mvua inaweza kunyesha',
                                    'Light rain' => 'Mvua kidogo',
                                    'Moderate rain' => 'Mvua wastani',
                                    'Heavy rain' => 'Mvua nyingi',
                                    'Thunderstorm' => 'Radi na mvua',
                                ][$day['day']['condition']['text']] ?? $day['day']['condition']['text'];
                            @endphp
                                {{ $haliHewa }}
                        </span>
                        </div>
                        <div class="text-right">
                            <p class="font-medium">{{ $day['day']['maxtemp_c'] }}°C / {{ $day['day']['mintemp_c'] }}
                                °C</p>
                            <p class="text-sm text-gray-600">Unyevu: {{ $day['day']['avghumidity'] }}%</p>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr class="border-gray-200">
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
<x-footer/>
</body>
</html>
