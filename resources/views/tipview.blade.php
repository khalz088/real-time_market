<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <style>
        body {
            background-color: #f5f1e3;
        }

        .agrilink-green {
            color: #385c35;
        }

        .agrilink-bg {
            background-color: #385c35;
        }

        .agrilink-border {
            border-color: #385c35;
        }

        .agrilink-card {
            background-color: #faf7ee;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans">
<div class="sticky top-0 z-50">
    <x-topnav/>
</div>
<div class="min-h-[80vh] px-4 py-5 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8"
     x-data="{ openModal: false, selectedTip: null, search: '' }">

    <!-- Search and Add Button Section -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <div class="relative w-full ">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input
                x-model="search"
                type="text"
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#385c35] focus:border-[#385c35] sm:text-sm"
                placeholder="Search tips..."
            >
        </div>

    </div>

    <!-- Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($tips as $item)
            <div
                x-show="search === '' || '{{ strtolower($item->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($item->description) }}'.includes(search.toLowerCase())"
                @click="openModal = true; selectedTip = {
                    name: '{{ $item->name }}',
                    banner: '{{ $item->banner ? asset('storage/' . $item->banner) : 'https://images.pexels.com/photos/139829/pexels-photo-139829.jpeg' }}',
                    description: `{{ $item->description }}`,
                    created_at: '{{ $item->created_at->format('d M Y') }}'
                }"
                class="overflow-hidden transition-shadow duration-300 bg-white rounded-lg shadow-md cursor-pointer hover:shadow-lg border border-gray-200"
            >
                <img
                    src="{{ $item->banner ? asset('storage/' . $item->banner) : 'https://images.pexels.com/photos/139829/pexels-photo-139829.jpeg' }}"
                    class="object-cover w-full h-64"
                    alt="{{ $item->name }}"
                />
                <div class="p-5 border-t border-gray-200">
                    <p class="mb-3 text-xs font-semibold tracking-wide uppercase text-gray-500">
                        <span>Posted on {{ $item->created_at->format('d M Y') }}</span>
                    </p>
                    <h3 class="mb-3 text-xl font-bold leading-5 text-gray-900">
                        {{ $item->name }}
                    </h3>
                    <p class="mb-4 text-gray-700 line-clamp-2">
                        {{ \Illuminate\Support\Str::words($item->description, 10, '...') }}

                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div
        x-show="openModal"
        @click.away="openModal = false"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div
            class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
            @click.stop
        >
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-bold text-gray-900" x-text="selectedTip?.name"></h3>
                <button @click="openModal = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <img
                    :src="selectedTip?.banner"
                    class="w-full h-64 object-cover rounded-lg mb-6"
                    :alt="selectedTip?.name"
                />
                <div class="prose max-w-none">
                    <p class="text-sm text-gray-500 mb-2" x-text="'Posted on ' + selectedTip?.created_at"></p>
                    <p class="text-gray-700 whitespace-pre-line" x-text="selectedTip?.description"></p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 border-t flex justify-end">
                <button
                    @click="openModal = false"
                    class="px-4 py-2 bg-[#385c35] text-white rounded hover:bg-[#2a4a27] transition-colors"
                >
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Pagination controls -->
    <div class="mt-8 p-4 flex justify-between items-center">
        <span class="text-gray-700">
            Showing {{ ($tips->currentPage() - 1) * $tips->perPage() + 1 }} -
            {{ min($tips->currentPage() * $tips->perPage(), $tips->total()) }} of {{ $tips->total() }} records
        </span>
        <div class="flex space-x-2">
            @if ($tips->currentPage() > 1)
                <a href="{{ $tips->previousPageUrl() }}"
                   class="px-4 py-2 bg-[#385c35] text-white rounded hover:bg-[#2a4a27]">
                    Previous
                </a>
            @endif
            @if ($tips->hasMorePages())
                <a href="{{ $tips->nextPageUrl() }}"
                   class="px-4 py-2 bg-[#385c35] text-white rounded hover:bg-[#2a4a27]">
                    Next
                </a>
            @endif
        </div>
    </div>
</div>

<x-footer/>
</body>
</html>
