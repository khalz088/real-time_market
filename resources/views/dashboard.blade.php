<x-app-layout>
    <div class="mx-auto p-6">
        <!-- Wilaya Selector Form -->
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <label for="wilaya" class="block mb-1 font-medium  text-[#385c35]">Chagua Wilaya:</label>
            <select name="wilaya" id="wilaya" onchange="this.form.submit()" class="border p-2 rounded">
                @foreach(['Nyamagana','Ilemela','Magu','Sengerema','Ukerewe','Misungwi','Kwimba'] as $item)
                    <option value="{{ $item }}" {{ $item == $wilaya ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </form>

        <!-- Weather Card -->
        <div class="rounded-xl shadow p-6 border border-[#385c35] mb-6">
            <h2 class="text-xl font-semibold mb-2">Hali ya Hewa - {{ $wilaya }}</h2>
            @if(isset($weather['current']))
                <div class="flex items-center gap-4">
                    <img src="https:{{ $weather['current']['condition']['icon'] }}" alt="picha ya hali ya hewa">
                    <div>
                        <p class="text-lg font-medium">{{ $weather['current']['condition']['text'] }}</p>
                        <p>🌡️ Joto: {{ $weather['current']['temp_c'] }}°C</p>
                        <p>💧 Unyevu: {{ $weather['current']['humidity'] }}%</p>
                        <p>🌬️ Upepo: {{ $weather['current']['wind_kph'] }} km/h</p>
                        <p class="text-sm text-gray-600 mt-2">Iliwasilishwa
                            saa: {{ \Carbon\Carbon::parse($weather['current']['last_updated'])->format('H:i') }}</p>
                    </div>
                </div>
            @else
                <p class="text-red-600">Samahani, hatukuweza kupata taarifa za hali ya hewa.</p>
            @endif
        </div>

        <!-- Product Carousel -->
        <div
            class="w-full   ">
            <!-- Product Carousel -->
            <div x-data="{
    currentIndex: 0,
    products: [],
    rawProducts: {{ Js::from($products->items()) }}, // Pass raw product array from server
    interval: null,
    isMobile: window.innerWidth < 1024,
    init() {
        // Chunk products client-side based on isMobile
        this.products = this.chunkArray(this.rawProducts, this.isMobile ? 1 : 3);
        this.startAutoSlide();
        this.$watch('currentIndex', () => {
            if (this.currentIndex >= this.products.length) this.currentIndex = 0;
        });

        // Update on window resize
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 1024;
            this.products = this.chunkArray(this.rawProducts, this.isMobile ? 1 : 3);
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
                 class="relative w-full "
                 @mouseenter="stopAutoSlide()"
                 @mouseleave="startAutoSlide()">

                <h2 class="text-xl font-semibold mb-4  text-center">Bidhaa Zinazopendwa</h2>

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
                            class="absolute top-0 left-0 w-full grid grid-cols-1 lg:grid-cols-3 gap-4"
                        >
                            <template x-for="product in group" :key="product.id">
                                <div class="bg-white rounded-lg shadow-md p-4 border border-[#385c35]">
                                    <h3 class="font-medium text-lg text-[#385c35]" x-text="product.name"></h3>
                                    <p class="text-[#385c35]" x-text="product.category.name"></p>

                                    <template x-if="product.market_price && product.market_price.length > 0">
                                        <div class="mt-2 space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-[#385c35]">Bei ya Rejareja:</span>
                                                <span class="font-medium text-[#385c35]"
                                                      x-text="'TZS ' + product.market_price[0].retail_price.toLocaleString('en-US')">
                                    </span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-[#385c35]">Bei ya Jumla:</span>
                                                <span class="font-medium "
                                                      x-text="'TZS ' + product.market_price[0].wholesale_price.toLocaleString('en-US')">
                                    </span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span>Mwenendo:</span>
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
                            :class="currentIndex === index ? 'bg-[#385c35]' : 'bg-gray-300'"
                        ></button>
                    </template>
                </div>
            </div>
        </div>
</x-app-layout>
