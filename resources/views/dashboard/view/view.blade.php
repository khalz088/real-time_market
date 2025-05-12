<x-app-layout>
    <div x-data="{ search: '', openModal: false, selectedProduct: null }" class="min-h-screen">
        <!-- Search Input -->
        <div class="flex justify-end p-4">
            <input
                type="text"
                x-model="search"
                class="px-4 py-2 border rounded  border-[#385c35] text-black"
                placeholder="Search products..."
            >
        </div>

        <!-- Table -->
        <div class="overflow-x-auto p-4 ">
            <table class="min-w-full table-auto border-collapse border border-[#385c35] ">
                <thead>
                <tr class="bg-[#385c35]  text-black  text-center">
                    <th class="px-4 py-2 border border-white">#</th>
                    <th class="px-4 py-2 border border-white">Name</th>
                    <th class="px-4 py-2 border border-white">Trend</th>
                    <th class="px-4 py-2 border border-white">Change %</th>
                    <th class="px-4 py-2 text-center border border-white">Actions</th>
                </tr>
                </thead>

                @if($products->count() > 0)
                    <tbody>
                    @foreach($products as $index => $product)
                        @php
                            $marketPrice = $product->market_price->first();
                        @endphp
                        <template
                            x-if="search === '' || '{{ $product->name }}'.toLowerCase().includes(search.toLowerCase())">
                            <tr class="border-b border-[#385c35] text-center">
                                <td class="px-4 py-2 border border-[#385c35]">{{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}</td>
                                <td class="px-4 py-2 border border-[#385c35]">{{ $product->name }}</td>
                                <td class="px-4 py-2 border border-[#385c35]">
                                    @if($marketPrice && $marketPrice->price_trend === 'up')
                                        <div
                                            class="flex items-center justify-center text-green-600 dark:text-green-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            Increasing
                                        </div>
                                    @elseif($marketPrice && $marketPrice->price_trend === 'down')
                                        <div class="flex items-center justify-center text-red-600 dark:text-red-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586l-4.293-4.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            Decreasing
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center text-gray-600 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            Stable
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-[#385c35]">
                                    @if($marketPrice)
                                        @if($marketPrice->price_change_percent > 0)
                                            <span class="text-green-600 dark:text-green-400">+{{ number_format($marketPrice->price_change_percent, 2) }}%</span>
                                        @elseif($marketPrice->price_change_percent < 0)
                                            <span class="text-red-600 dark:text-red-400">{{ number_format($marketPrice->price_change_percent, 2) }}%</span>
                                        @else
                                            <span>{{ number_format($marketPrice->price_change_percent, 2) }}%</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center border border-[#385c35]">
                                    <div class="flex justify-center space-x-2">
                                        <x-primary-button
                                            @click="openModal = true; selectedProduct = {
                                                id: {{ $product->id }},
                                                name: '{{ addslashes($product->name) }}',
                                                category: '{{ addslashes($product->category->name) }}',
                                                description: `{{ addslashes($product->description) }}`,
                                                measurement_unit: '{{ $product->measurement_unit }}',
                                                seasonal: {{ $product->seasonal ? 'true' : 'false' }},
                                                retail_price: {{ $marketPrice->retail_price ?? 0 }},
                                                wholesale_price: {{ $marketPrice->wholesale_price ?? 0 }},
                                                quantity_available: {{ $marketPrice->quantity_available ?? 0 }},
                                                is_organic: {{ $marketPrice->is_organic ? 'true' : 'false' }},
                                                price_trend: '{{ $marketPrice->price_trend ?? 'stable' }}',
                                                price_change_percent: {{ $marketPrice->price_change_percent ?? 0 }}
                                            }"
                                        >
                                            More
                                        </x-primary-button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>

        <!-- Product Details Modal -->
        <div
            x-show="openModal"
            x-transition
            @keydown.escape.window="openModal = false"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            x-cloak
        >
            <div class="bg-[#f5f1e3] border border-[#385c35] rounded-lg shadow-lg w-full max-w-2xl p-6"
                 @click.away="openModal = false">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 "
                        x-text="selectedProduct ? selectedProduct.name : ''"></h2>
                    <button @click="openModal = false"
                            class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="mb-6">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-500  mr-2">Price Trend:</span>
                        <template x-if="selectedProduct">
                            <div class="flex items-center">
                                <template x-if="selectedProduct.price_trend === 'up'">
                                    <div class="flex items-center text-green-600 dark:text-green-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span
                                            x-text="'Increasing (' + selectedProduct.price_change_percent + '%)'"></span>
                                    </div>
                                </template>
                                <template x-if="selectedProduct.price_trend === 'down'">
                                    <div class="flex items-center text-red-600 dark:text-red-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586l-4.293-4.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span
                                            x-text="'Decreasing (' + selectedProduct.price_change_percent + '%)'"></span>
                                    </div>
                                </template>
                                <template x-if="selectedProduct.price_trend === 'stable'">
                                    <div class="flex items-center text-gray-600 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span x-text="'Stable (' + selectedProduct.price_change_percent + '%)'"></span>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900  border-b border-[#385c35] pb-2">Product
                            Details</h3>
                        <div>
                            <p class="text-sm text-gray-500 ">Category</p>
                            <p class="text-gray-900 " x-text="selectedProduct?.category"></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 ">Description</p>
                            <p class="text-gray-900  whitespace-pre-line "
                               x-text="selectedProduct?.description"></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 ">Measurement Unit</p>
                            <p class="text-gray-900 " x-text="selectedProduct?.measurement_unit"></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 ">Seasonal Product</p>
                            <p class="text-gray-900 "
                               x-text="selectedProduct?.seasonal ? 'Yes' : 'No'"></p>
                        </div>
                    </div>

                    <!-- Market Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900  border-b border-[#385c35] pb-2">Market Data</h3>
                        <div>
                            <p class="text-sm text-gray-500 ">Retail Price</p>
                            <p class="text-gray-900 "
                               x-text="selectedProduct ? 'TZS ' + selectedProduct.retail_price.toLocaleString('en-US', {minimumFractionDigits: 2}) : ''">
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 ">Wholesale Price</p>
                            <p class="text-gray-900 "
                               x-text="selectedProduct ? 'TZS ' + selectedProduct.wholesale_price.toLocaleString('en-US', {minimumFractionDigits: 2}) : ''">
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 ">Available Quantity</p>
                            <p class="text-gray-900 "
                               x-text="selectedProduct ? selectedProduct.quantity_available.toLocaleString('en-US') + ' ' + selectedProduct.measurement_unit : ''">
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 ">Organic Certification</p>
                            <p class="text-gray-900 "
                               x-text="selectedProduct?.is_organic ? 'Certified Organic' : 'Not Organic'"></p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-primary-button @click="openModal = false"
                    >
                        Close
                    </x-primary-button>
                </div>
            </div>
        </div>

        <!-- Pagination controls -->
        <div class="mt-4 flex justify-between items-center px-4 ">
            <span>
                Showing {{ ($products->currentPage() - 1) * $products->perPage() + 1 }} to
                {{ min($products->currentPage() * $products->perPage(), $products->total()) }} of {{ $products->total() }} products
            </span>
            <div class="flex space-x-2">
                @if ($products->currentPage() > 1)
                    <a href="{{ $products->previousPageUrl() }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-black  rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                        Previous
                    </a>
                @endif
                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-black  rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                        Next
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
