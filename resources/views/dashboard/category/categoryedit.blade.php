<x-app-layout>
    <div class="p-4 sm:p-8 bg-white dark:bg-neutral-950 dark:border-white border border-neutral-950   rounded-lg">
        <div class="max-w-xl">
            <form method="post" action="{{ route('category.update', $category->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('put')
                <div>
                    <label class="text-black dark:text-white" for="name" > name </label>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category->name)"  autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
