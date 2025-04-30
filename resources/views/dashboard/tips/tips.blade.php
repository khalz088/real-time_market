<x-app-layout>
    <div x-data="{ search: '' }" class="min-h-screen">
        <!-- Search Input -->
        <div class="sm:flex sm:justify-between p-4">
            <input
                type="text"
                x-model="search"
                class="px-4 py-2 border rounded dark:bg-gray-800 dark:text-white"
                placeholder="Search tips..."
            >
            <a href="{{ route('tips.add') }}">
                <button class="px-4 py-2 bg-blue-500 text-white rounded inline-flex items-center sm:mt-0 mt-4">
                    <x-heroicon-o-plus class="h-5 w-5"/>
                    Add Tip
                </button>
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto p-4 dark:text-white">
            <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600">
                <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-black dark:text-white text-center">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Tip Name</th>
                    <th class="px-4 py-2 text-center border">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tips as $index => $item)
                    <template x-if="search === '' || '{{ $item->name }}'.toLowerCase().includes(search.toLowerCase())">
                        <tr class="border-b dark:border-gray-600 text-center">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $item->name }}</td>
                            <td class="px-4 py-2 text-center border">
                                <div class="flex justify-center space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('tips.show', $item->id) }}" class="text-blue-500 hover:underline">
                                        <x-heroicon-c-pencil-square class="w-5 h-5"/>
                                    </a>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('tips.destroy', $item->id) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this tip?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">
                                            <x-heroicon-c-trash class="w-5 h-5"/>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </template>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination controls -->
        <div class="mt-4 p-4 flex justify-between items-center dark:text-white">
            <span>
                Showing {{ ($tips->currentPage() - 1) * $tips->perPage() + 1 }} -
                {{ min($tips->currentPage() * $tips->perPage(), $tips->total()) }} of {{ $tips->total() }} records
            </span>
            <div class="flex space-x-2">
                @if ($tips->currentPage() > 1)
                    <a href="{{ $tips->previousPageUrl() }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white text-black rounded">Previous</a>
                @endif
                @if ($tips->hasMorePages())
                    <a href="{{ $tips->nextPageUrl() }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 dark:text-white text-black rounded">Next</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
