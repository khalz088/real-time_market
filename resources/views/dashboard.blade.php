<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <label for="wilaya" class="block mb-1 font-medium dark:text-white text-black">Chagua Wilaya:</label>
            <select name="wilaya" id="wilaya" onchange="this.form.submit()" class="border p-2 rounded">
                @foreach(['Nyamagana','Ilemela','Magu','Sengerema','Ukerewe','Misungwi','Kwimba'] as $item)
                    <option value="{{ $item }}" {{ $item == $wilaya ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </form>

        <div class="bg-white rounded-xl shadow p-6 border border-black dark:border-white">
            <h2 class="text-xl font-semibold mb-2">Hali ya Hewa - {{ $wilaya }}</h2>

            @if(isset($weather['current']))
                <div class="flex items-center gap-4">
                    <img src="https:{{ $weather['current']['condition']['icon'] }}" alt="picha ya hali ya hewa">
                    <div>
                        <p class="text-lg font-medium">{{ $weather['current']['condition']['text'] }}</p>
                        <p>🌡️ Joto: {{ $weather['current']['temp_c'] }}°C</p>
                        <p>💧 Unyevu: {{ $weather['current']['humidity'] }}%</p>
                        <p>🌬️ Upepo: {{ $weather['current']['wind_kph'] }} km/h</p>
                        <p class="text-sm text-gray-600 mt-2">Ilisasishwa saa: {{ \Carbon\Carbon::parse($weather['current']['last_updated'])->format('H:i') }}</p>
                    </div>
                </div>
            @else
                <p class="text-red-600">Samahani, hatukuweza kupata taarifa za hali ya hewa.</p>
            @endif
        </div>
    </div>
</x-app-layout>
