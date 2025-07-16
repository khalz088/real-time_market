<x-app-layout>
    <div class="p-4 sm:p-8 bg-white border border-[#385c35] rounded-lg">
        <div class="">
            <form method="post"
                  action="{{ isset($market) ? route('market.update', $market->id) : route('market.store') }}"
                  class="mt-6 space-y-6">
                @csrf
                @if(isset($market))
                    @method('PUT')
                @endif

                <!-- Market Name Field -->
                <div>
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Market Name')"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                      :value="old('name', $market->name ?? '')" required autofocus/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
