<x-app-layout>
    <div class="p-4 sm:p-8  border border-[#385c35] rounded-lg">
        <div class="max-w-xl">
            <form method="post" action="{{ route('tips.update', $tip->id) }}" class="mt-6 space-y-6"
                  enctype="multipart/form-data">
                @csrf
                @method('put')

                <!-- Name Field -->
                <div>
                    <x-input-label for="name" class="text-black" :value="__('Tip Name')"/>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                  :value="old('name', $tip->name)" required autofocus/>
                    <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                </div>

                <!-- Banner Image Field -->
                <div>
                    <x-input-label for="banner" class="text-black" :value="__('Banner Image')"/>

                    <!-- Current Image Preview -->
                    @if($tip->banner)
                        <div class="mt-2 mb-4">
                            <p class="text-sm text-gray-400 mb-1">Current Banner:</p>
                            <img src="{{ asset('storage/' . $tip->banner) }}" alt="Current banner"
                                 class="h-32 rounded-lg">
                        </div>
                    @endif

                    <input id="banner" name="banner" type="file"
                           class="block mt-1 w-full text-black file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-black hover:file:bg-blue-600"
                           accept="image/jpeg,image/png,image/jpg,image/gif">
                    <x-input-error class="mt-2" :messages="$errors->get('banner')"/>
                    <p class="mt-1 text-sm text-gray-400">Leave empty to keep current image (Max 2MB: JPEG, PNG, JPG,
                        GIF)</p>
                </div>

                <!-- Description Field -->
                <div>
                    <x-input-label for="description" class="text-black" :value="__('Description')"/>
                    <textarea id="description" name="description" rows="4"
                              class="block mt-1 w-full rounded-md shadow-sm text-black "
                              required>{{ old('description', $tip->description) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                </div>

                <!-- New Image Preview -->
                <div id="image-preview" class="hidden mt-4">
                    <x-input-label class="text-black" :value="__('New Banner Preview')"/>
                    <img id="preview" class="mt-2 rounded-lg max-h-48" src="#" alt="Banner preview"/>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Update Tip') }}</x-primary-button>
                    <a href="{{ route('tips.index') }}" class=" hover:underline">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('banner').addEventListener('change', function (e) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');

            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
</x-app-layout>
