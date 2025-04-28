<x-app-layout>
    <div x-data="{ search: '' }" class="min-h-screen">
        <!-- Search Input -->
        <div class="sm:flex sm:justify-between p-4 ">
            <input
                type="text"
                x-model="search"
                class="px-4 py-2 border rounded"
                placeholder="Search categories..."
            >
           <a href="{{ route('category.add') }}"> <button class="px-4 py-2 bg-blue-500 text-white rounded inline-flex items-center sm:mt-0 mt-4"> <x-heroicon-o-plus class="h-5 w-5 "/> Add</button> </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto p-4 dark:text-white">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-200 text-black text-center">
                    <th class="px-4 py-2 border">#</th> <!-- Index Column -->
                    <th class="px-4 py-2 border">Category Name</th>
                    <th class="px-4 py-2 text-center border">Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Filtered Rows Based on Search -->
                @foreach($category as $index => $item)
                    <template x-if="search === '' || '{{ $item->name }}'.toLowerCase().includes(search.toLowerCase())">
                        <tr class="border-b text-center">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td> <!-- Display Row Number -->
                            <td class="px-4 py-2 border">{{ $item->name }}</td>
                            <td class="px-4 py-2 text-center border">
                                <div class="flex justify-center space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('category.show', $item->id) }}" class="text-blue-500 hover:underline">
                                        <x-heroicon-c-pencil-square class="w-5 h-5"/>
                                    </a>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('category.destroy', $item->id) }}" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
        <div class="mt-4 flex justify-between items-center dark:text-white">
            <span>
                Showing {{ ($category->currentPage() - 1) * $category->perPage() + 1 }} -
                {{ min($category->currentPage() * $category->perPage(), $category->total()) }} of {{ $category->total() }} records
            </span>
            <div class="flex space-x-2">
                @if ($category->currentPage() > 1)
                    <a href="{{ $category->previousPageUrl() }}" class="px-4 py-2 bg-gray-300 text-black rounded">Previous</a>
                @endif
                @if ($category->hasMorePages())
                    <a href="{{ $category->nextPageUrl() }}" class="px-4 py-2 bg-gray-300 text-black rounded">Next</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
