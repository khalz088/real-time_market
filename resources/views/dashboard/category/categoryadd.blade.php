<x-app-layout>
    <div class="p-4 sm:p-8 bg-white dark:bg-neutral-950 dark:border-white border border-neutral-950   rounded-lg">
        <div class="max-w-xl">
            <form method="post" action="{{ route('category.store') }}" class="mt-6 space-y-6">
                @csrf
                @method('post')
                <div>
                    <x-input-label for="name" class="text-white" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
