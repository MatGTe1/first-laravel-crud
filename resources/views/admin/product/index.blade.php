<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Products List</h2>

        <div class="mb-4">
            <a href="{{ route('admin.products.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Create Product
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 ">ID</th>
                        <th class="px-6 py-3 ">Name</th>
                        <th class="px-6 py-3 ">Price</th>
                        <th class="px-6 py-3 ">Quantity</th>
                        <th class="px-6 py-3 ">Description</th>
                        <th class="px-6 py-3 ">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                    <tr>
                        <td class="px-6 py-4 ">{{ $product->id }}</td>
                        <td class="px-6 py-4 ">{{ $product->name }}</td>
                        <td class="px-6 py-4 ">{{ $product->price }}</td>
                        <td class="px-6 py-4 ">{{ $product->quantity }}</td>
                        <td class="px-6 py-4 ">{{ $product->description }}</td>
                        <td class="px-6 py-4 ">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 ">
                                Edit
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>