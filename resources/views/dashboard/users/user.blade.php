<x-app-layout>
    <div x-data="{ search: '' }" class="min-h-screen">
        <!-- Search Input -->
        <div class="flex justify-end p-4 ">
            <input
                type="text"
                x-model="search"
                class="px-4 py-2 border rounded"
                placeholder="Search users..."
            >
        </div>
        <!-- Table -->
        <div class="overflow-x-auto p-4 ">
            <table class="min-w-full table-auto border-collapse border border-[#385c35] text-black">
                <thead>
                <tr class="bg-gray-200 text-black text-center">
                    <th class="px-4 py-2 border border-[#385c35]">#</th>
                    <th class="px-4 py-2 border border-[#385c35]">Name</th>
                    <th class="px-4 py-2 border border-[#385c35]">Status</th>
                    <th class="px-4 py-2 border border-[#385c35]">Role</th>
                    <th class="px-4 py-2 text-center border border-[#385c35]">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $item)
                    <template x-if="search === '' || '{{ $item->name }}'.toLowerCase().includes(search.toLowerCase())">
                        <tr class="border-b text-center">
                            <td class="px-4 py-2 border border-[#385c35]">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border border-[#385c35]">{{ $item->name }}</td>
                            <td class="px-4 py-2 border border-[#385c35]">
                                <form method="POST" action="{{ route('users.update-status', $item->id) }}"
                                      id="status-form-{{ $item->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            class="sr-only peer"
                                            name="active"
                                            value="1"
                                            @if($item->active) checked @endif
                                            onchange="document.getElementById('status-form-{{ $item->id }}').submit()"
                                        >
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                        <span class="ml-3 text-sm font-medium">
                                            @if($item->active)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </span>
                                    </label>
                                </form>
                            </td>
                            <td class="px-4 py-2 border border-[#385c35]">
                                <form method="POST" action="{{ route('users.update-role', $item->id) }}"
                                      id="role-form-{{ $item->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            class="sr-only peer"
                                            name="role_id"
                                            value="2"
                                            @if($item->role_id === 2) checked @endif
                                            onchange="document.getElementById('role-form-{{ $item->id }}').submit()"
                                        >
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                        <span class="ml-3 text-sm font-medium">
                                            @if($item->role_id === 2)
                                                Admin
                                            @else
                                                User
                                            @endif
                                        </span>
                                    </label>
                                </form>
                            </td>
                            <td class="px-4 py-2 text-center border border-[#385c35]">
                                <div class="flex justify-center space-x-2">
                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('user.destroy', $item->id) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this user?')">
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
                Showing {{ ($users->currentPage() - 1) * $users->perPage() + 1 }} -
                {{ min($users->currentPage() * $users->perPage(), $users->total()) }} of {{ $users->total() }} records
            </span>
            <div class="flex space-x-2">
                @if ($users->currentPage() > 1)
                    <a href="{{ $users->previousPageUrl() }}"
                       class="px-4 py-2 bg-gray-300 text-black rounded">Previous</a>
                @endif
                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="px-4 py-2 bg-gray-300 text-black rounded">Next</a>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>

