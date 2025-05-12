<x-app-layout>
    <div class="p-4 sm:p-8  border border-[#385c35] rounded-lg">
        <div class="max-w-xl">
            <form method="post" action="{{ route('tips.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                @csrf

                <!-- Name Field -->
                <div>
                    <x-input-label for="name" :value="__('Tip Name')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                  required autofocus/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <!-- Banner Image Upload -->
                <div>
                    <x-input-label for="banner" :value="__('Banner Image')"/>
                    <input id="banner"
                           class="block mt-1 w-full  text-black file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file: hover:file:bg-blue-600"
                           type="file" name="banner" accept="image/jpeg,image/png,image/jpg,image/gif" required/>
                    <x-input-error :messages="$errors->get('banner')" class="mt-2"/>
                    <p class="mt-1 text-sm text-gray-400">Max 2MB (JPEG, PNG, JPG, GIF)</p>
                </div>

                <!-- Description Field -->
                <div>
                    <x-input-label for="description" :value="__('Description')"/>
                    <textarea id="description" name="description" rows="4"
                              class="block mt-1 w-full rounded-md text-black"
                              required>{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                </div>

                <!-- Preview of Selected Image -->
                <div id="image-preview" class="hidden mt-4">
                    <x-input-label class="" :value="__('Image Preview')"/>
                    <img id="preview" class="mt-2 rounded-lg max-h-48" src="#" alt="Banner preview"/>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save Tip') }}</x-primary-button>
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
