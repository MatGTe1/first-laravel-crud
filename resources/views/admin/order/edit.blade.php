<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Order</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">User</label>
                <select name="user_id" class="border rounded px-2 py-1 w-full">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Products</label>
                @foreach ($products as $product)
                <div class="flex items-center mb-2">
                    <div class="flex items-center space-x-2" style="width:250px">
                        <input
                            type="checkbox"
                            name="products[]"
                            value="{{$product->id}}"
                            class="product-checkbox"
                            {{ $order->products->contains($product->id) ? 'checked' : '' }}
                            data-product-id="{{ $product->id }}">
                        <span>{{$product->name}} - {{$product->price}} zł</span>
                    </div>
                    @php
                    $productInOrder=$order->products->firstWhere('id', $product->id);
                    $checked = $productInOrder ? 'checked' : '';
                    $quanityOfProductInOrder = $productInOrder ? $productInOrder->pivot->quantity : '';

                    @endphp

                    <div class="ml-4">
                        <input
                            name="selectedQuantities[{{ $product->id }}]"
                            class="quantity-input w-20  px-2 py-1 border rounded"
                            type="number"
                            min="0"
                            step="1"
                            max="{{ $product->avaibleQuantity }}"
                            {{ $productInOrder ? '' : 'disabled' }}
                            data-product-id="{{ $product->id }}"
                            value="{{ $quanityOfProductInOrder }}">

                        <span>rest in stock: {{ $product->avaibleQuantity - (int) $quanityOfProductInOrder}}

                        </span>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <input type="text" name="status" class="border rounded px-2 py-1 w-full" placeholder="pending">
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Create
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.product-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const productId = this.dataset.productId;
                    const quantityInput = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);

                    if (this.checked) {
                        quantityInput.disabled = false;
                        quantityInput.focus();
                    } else {
                        quantityInput.disabled = true;
                        quantityInput.value = '';
                    }
                })
            })
        })
    </script>
</x-app-layout>