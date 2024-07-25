<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-900">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="p-24">
        <!-- Button to Open Modal -->
        <button type="button" class="px-4 py-2 bg-blue-500 text-white rounded-md mb-4" data-modal-toggle="category-modal">
            Add New Category
        </button>

        <!-- Categories Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Slug</th>
                        <th class="py-2 px-4 border-b">Details</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $category->category_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $category->slug }}</td>
                        <td class="py-2 px-4 border-b">{{ $category->category_details }}</td>
                        <td class="py-2 px-4 border-b">
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-500" data-confirm="Are you sure you want to delete this category?">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Adding Category -->
    <div id="category-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-md shadow-lg max-w-md w-full">
            <h2 class="text-xl font-bold mb-4">Add New Category</h2>
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="category_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" id="category_name" name="category_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="category_details" class="block text-sm font-medium text-gray-700">Category Details</label>
                    <textarea id="category_details" name="category_details" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2" data-modal-toggle="category-modal">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Add Category</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to toggle the modal visibility
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.getElementById(button.getAttribute('data-modal-toggle'));
                modal.classList.toggle('hidden');
            });
        });

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('fixed')) {
                e.target.classList.add('hidden');
            }
        });

        // Confirmation message for delete
        document.querySelectorAll('[data-confirm]').forEach(button => {
            button.addEventListener('click', (e) => {
                if (!confirm(button.getAttribute('data-confirm'))) {
                    e.preventDefault();
                } else {
                    button.closest('form').submit();
                }
            });
        });
    </script>
</x-app-layout>
