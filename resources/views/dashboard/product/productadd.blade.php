<x-app-layout>
    <div class="p-4 sm:p-8 bg-white border border-[#385c35] rounded-lg">
        <div class="">
            <form method="post" action="{{ route('product.store') }}" class="mt-6 space-y-6">
                @csrf

                <!-- Agricultural Product Fields -->
                <div class="grid sm:grid-cols-2 grid-cols-1 gap-5">
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Product Name')"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                      required autofocus/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')"/>
                        <select id="category_id" name="category_id"
                                class="block w-full rounded-md text-black focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                    </div>

                    <!-- New Market Selection Field -->
                    <div class="mt-4">
                        <x-input-label for="market_id" :value="__('Market')"/>
                        <select id="market_id" name="market_id"
                                class="block w-full rounded-md text-black focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                required>
                            <option value="">Select a market</option>
                            @foreach($markets as $market)
                                <option
                                    value="{{ $market->id }}" {{ old('market_id') == $market->id ? 'selected' : '' }}>
                                    {{ $market->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('market_id')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')"/>
                        <textarea id="description" name="description"
                                  class="block mt-1 w-full rounded-md text-black shadow-sm"
                                  required>{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="measurement_unit" :value="__('Measurement Unit')"/>
                        <select id="measurement_unit" name="measurement_unit"
                                class="block mt-1 w-full rounded-md text-black shadow-sm"
                                required>
                            <option value="">Select a unit</option>
                            <option value="kg" {{ old('measurement_unit') == 'kg' ? 'selected' : '' }}>kg (Kilogram)
                            </option>
                            <option value="g" {{ old('measurement_unit') == 'g' ? 'selected' : '' }}>g (Gram)</option>
                            <option value="lb" {{ old('measurement_unit') == 'lb' ? 'selected' : '' }}>lb (Pound)
                            </option>
                            <option value="oz" {{ old('measurement_unit') == 'oz' ? 'selected' : '' }}>oz (Ounce)
                            </option>
                            <option value="l" {{ old('measurement_unit') == 'l' ? 'selected' : '' }}>l (Liter)</option>
                            <option value="ml" {{ old('measurement_unit') == 'ml' ? 'selected' : '' }}>ml (Milliliter)
                            </option>
                            <option value="piece" {{ old('measurement_unit') == 'piece' ? 'selected' : '' }}>Piece
                            </option>
                            <option value="dozen" {{ old('measurement_unit') == 'dozen' ? 'selected' : '' }}>Dozen
                            </option>
                            <option value="bunch" {{ old('measurement_unit') == 'bunch' ? 'selected' : '' }}>Bunch
                            </option>
                            <option value="bag" {{ old('measurement_unit') == 'bag' ? 'selected' : '' }}>Bag</option>
                            <option value="box" {{ old('measurement_unit') == 'box' ? 'selected' : '' }}>Box</option>
                            <option value="crate" {{ old('measurement_unit') == 'crate' ? 'selected' : '' }}>Crate
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('measurement_unit')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <label class="inline-flex items-center">
                            <input type="hidden" name="seasonal" value="0">
                            <input type="checkbox" name="seasonal" value="1"
                                   class="rounded text-[#385c35] shadow-sm"
                                   {{ old('seasonal') ? 'checked' : '' }}
                                   onclick="this.previousSibling.value = this.checked ? '1' : '0'">
                            <span class="ml-2 text-sm text-black">{{ __('Seasonal Product') }}</span>
                        </label>
                    </div>
                </div>

                <!-- Market Price Fields -->
                <div class="mt-6 pt-6 border-t border-[#385c35]">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Market Information') }}</h3>
                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-5 w-auto">
                        <div class="mt-4">
                            <x-input-label for="wholesale_price" :value="__('Wholesale Price')"/>
                            <x-text-input id="wholesale_price" class="block mt-1 w-full" type="number" step="0.01"
                                          name="wholesale_price" :value="old('wholesale_price')"/>
                            <x-input-error :messages="$errors->get('wholesale_price')" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="retail_price" :value="__('Retail Price')"/>
                            <x-text-input id="retail_price" class="block mt-1 w-full" type="number" step="0.01"
                                          name="retail_price" :value="old('retail_price')"/>
                            <x-input-error :messages="$errors->get('retail_price')" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="quantity_available" :value="__('Quantity Available')"/>
                            <x-text-input id="quantity_available" class="block mt-1 w-full" type="number"
                                          name="quantity_available" :value="old('quantity_available')" required/>
                            <x-input-error :messages="$errors->get('quantity_available')" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="hidden" name="is_organic" value="0">
                                <input type="checkbox" name="is_organic" value="1"
                                       class="rounded text-[#385c35] shadow-sm"
                                       {{ old('is_organic') ? 'checked' : '' }}
                                       onclick="this.previousSibling.value = this.checked ? '1' : '0'">
                                <span class="ml-2 text-sm text-black">{{ __('Organic Product') }}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
