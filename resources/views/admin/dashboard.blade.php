<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Successfully logged!") }}
                    <div class="mb-4 mt-4">
                        <a class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition" href="{{ route('admin.users.index') }}">Users</a>
                    </div>
                    <div class="mb-4">
                        <a class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition" href="{{ route('admin.products.index') }}">Products</a>
                    </div>
                    <div class="mb-4">
                        <a class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition" href="{{ route('admin.orders.index') }}">Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>