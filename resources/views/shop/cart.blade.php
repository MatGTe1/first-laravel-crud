<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Your cart</h2>
    </x-slot>

    @if(count($cart) > 0)
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 ">Name</th>
                    <th class="px-6 py-3 ">Description</th>
                    <th class="px-6 py-3 ">Quantity</th>
                    <th class="px-6 py-3 ">Price</th>
                    <th class="px-6 py-3 ">Total price</th>
                    <th class="px-6 py-3 ">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                $total=0.0;
                @endphp

                @foreach ($cart as $id => $item)

                @php
                $total=$total+$item['price'] * $item['quantity'];
                @endphp
                <tr>
                    <td class="px-6 py-4 ">{{ $item['name'] }}</td>
                    <td class="px-6 py-4 ">{{ $item['description'] }}</td>
                    <td class="px-6 py-4 ">{{ $item['quantity'] }}</td>
                    <td class="px-6 py-4 ">{{ number_format ($item['price'], 2, ',', ' ') }} zł</td>
                    <td class="px-6 py-4 ">{{ number_format ($item['price'] * $item['quantity'], 2, ',', ' ') }} zł</td>
                    <td class="px-6 py-4 ">
                        <form action="{{ route('cart.remove', $id) }}"
                            method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            <button type="submit"
                                class="text-red-600">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="text-right">
        <p class="inline-block font-bold m-12 text-2xl p-4 bg-white border-2 rounded">Total: {{ number_format ($total, 2, ',', ' ' )}} zł</p>
    </div>

    @if(session('cart'))
    <div class="text-right">
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <button type="submit" class="mr-12 text-2xl bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Make order
            </button>
        </form>
    </div>
    @endif

    @else
    <div class="text-right">
        <p class="inline-block font-bold m-12 text-2xl p-4 bg-white border-2 rounded">Empty cart</p>
    </div>
    @endif

</x-app-layout>