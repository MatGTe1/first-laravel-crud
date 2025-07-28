<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Home page</h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Our products</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                <p class="text-gray-600 mb-2">{{ $product->description }}</p>
                <p class="text-gray-600 mb-2">In stock: {{ $product->quantity }}</p>
                <p class="text-green-700 font-bold mb-2">{{ $product->price }} zł</p>

                @auth
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Add to cart
                    </button>
                </form>
                @else
                <a href="{{ route('register') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add to cart
                </a>
                @endauth
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>