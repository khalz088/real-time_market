<x-app-layout>
    <div class="p-4 sm:p-8 border border-[#385c35] rounded-lg">
        <div class="">
            <form method="post" action="{{ route('market.update', $market->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <!-- Market Name Field -->
                <div>
                    <x-input-label for="name" class="text-black" :value="__('Market Name')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                  :value="old('name', $market->name)" required autofocus/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                    <a href="{{ route('market.index') }}"
                       class="px-4 py-2 text-sm text-black">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
