<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">My Orders</h2>

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