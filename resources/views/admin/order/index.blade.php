<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Orders List</h2>

        <div class="mb-4">
            <a href="{{ route('admin.orders.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Create Order
            </a>
        </div>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Products</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                    <tr>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4">{{ $order->status }}</td>
                        <td class="px-6 py-4">
                            <ul class="list-disc list-inside">
                                @foreach ($order->products as $product)
                                <li>
                                    {{ $product->name }}
                                    <ul class=" ml-6 mt-1">
                                        <li>Units: {{ $product->pivot->quantity }}</li>
                                        <li>Price: {{ $product->price }} zł</li>
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="text-indigo-600 mr-2">
                                Edit
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                method="POST"
                                class="inline-block mr-2"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">
                                    Delete
                                </button>
                            </form>

                            <a href="{{ route('orders.print', $order->id) }}" class="text-green-600 mr-2">
                                Print_PDF
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>