<x-app-layout>
    <div class="p-4 sm:p-8  border border-[#385c35] rounded-lg">
        <div class="">
            <form method="post" action="{{ route('product.update', $product->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <!-- Agricultural Product Fields -->
                <div class="grid sm:grid-cols-2 grid-cols-1 gap-5">
                    <div>
                        <x-input-label for="name" class="text-black" :value="__('Product Name')"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                      :value="old('name', $product->name)" required autofocus/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category_id" class="text-black" :value="__('Category')"/>
                        <select id="category_id" name="category_id"
                                class="block mt-1 w-full rounded-md text-black shadow-sm"
                                required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" class="text-black" :value="__('Description')"/>
                        <textarea id="description" name="description"
                                  class="block mt-1 w-full rounded-md text-black shadow-sm"
                                  required>{{ old('description', $product->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="measurement_unit" class="text-black" :value="__('Measurement Unit')"/>
                        <select id="measurement_unit" name="measurement_unit"
                                class="block mt-1 w-full rounded-md text-black shadow-sm"
                                required>
                            <option value="">Select a unit</option>
                            @foreach(['kg', 'g', 'lb', 'oz', 'l', 'ml', 'piece', 'dozen', 'bunch', 'bag', 'box', 'crate'] as $unit)
                                <option
                                    value="{{ $unit }}" {{ old('measurement_unit', $product->measurement_unit) == $unit ? 'selected' : '' }}>
                                    {{ $unit }} @php
                                        // Display full unit names
                                        echo match($unit) {
                                            'kg' => '(Kilogram)',
                                            'g' => '(Gram)',
                                            'lb' => '(Pound)',
                                            'oz' => '(Ounce)',
                                            'l' => '(Liter)',
                                            'ml' => '(Milliliter)',
                                            default => ''
                                        };
                                    @endphp
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('measurement_unit')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <label class="inline-flex items-center">
                            <input type="hidden" name="seasonal" value="0">
                            <input
                                type="checkbox"
                                name="seasonal"
                                value="1"
                                class="rounded  text-[#385c35] shadow-sm "
                                {{ old('seasonal', $product->seasonal ?? false) ? 'checked' : '' }}
                                onclick="this.previousSibling.value = this.checked ? '1' : '0'"
                            >
                            <span
                                class="ml-2 text-sm text-black">{{ __('Seasonal Product') }}</span>
                        </label>
                    </div>
                </div>

                <!-- Market Price Fields -->
                <div class="mt-6 pt-6 border-t border-gray-200 ">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Market Information') }}</h3>
                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-5 w-auto">
                        <div class="mt-4">
                            <x-input-label for="wholesale_price" class="text-black" :value="__('Wholesale Price')"/>
                            <x-text-input id="wholesale_price" class="block mt-1 w-full" type="number" step="0.01"
                                          name="wholesale_price"
                                          :value="old('wholesale_price', $market->wholesale_price ?? '')"/>
                            <x-input-error :messages="$errors->get('wholesale_price')" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="retail_price" class="text-black" :value="__('Retail Price')"/>
                            <x-text-input id="retail_price" class="block mt-1 w-full" type="number" step="0.01"
                                          name="retail_price"
                                          :value="old('retail_price', $market->retail_price ?? '')"/>
                            <x-input-error :messages="$errors->get('retail_price')" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="quantity_available" class="text-black"
                                           :value="__('Quantity Available')"/>
                            <x-text-input id="quantity_available" class="block mt-1 w-full" type="number"
                                          name="quantity_available"
                                          :value="old('quantity_available', $market->quantity_available ?? '')"
                                          required/>
                            <x-input-error :messages="$errors->get('quantity_available')" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="hidden" name="is_organic" value="0">
                                <input
                                    type="checkbox"
                                    name="is_organic"
                                    value="1"
                                    class="rounded  text-[#385c35] shadow-sm "
                                    {{ old('is_organic', $market->is_organic ?? false) ? 'checked' : '' }}
                                    onclick="this.previousSibling.value = this.checked ? '1' : '0'"
                                >
                                <span
                                    class="ml-2 text-sm text-black">{{ __('Organic Product') }}</span>
                            </label>
                        </div>

                        <!-- Display auto-calculated fields (readonly) -->
                        @if(isset($market))
                            <div class="mt-4">
                                <x-input-label class="text-black" :value="__('Price Change Percentage')"/>
                                <x-text-input class="block mt-1 w-full bg-gray-100 " type="text"
                                              :value="$market->price_change_percent . '%'" readonly/>
                            </div>

                            <div class="mt-4">
                                <x-input-label class="text-black" :value="__('Price Trend')"/>
                                <x-text-input class="block mt-1 w-full bg-gray-100 " type="text"
                                              :value="match($market->price_trend) {
                                    'up' => 'Increasing',
                                    'down' => 'Decreasing',
                                    default => 'Stable'
                                }" readonly/>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                    <a href="{{ route('agricultural_product.index') }}"
                       class="px-4 py-2 text-sm text-black">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
