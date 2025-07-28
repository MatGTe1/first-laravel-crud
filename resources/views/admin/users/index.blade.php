<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Users List</h2>

            <div class="mb-4">
                <a href="{{ route('admin.users.create') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Create User
                </a>
            </div>


        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 ">ID</th>
                        <th class="px-6 py-3 ">Name</th>
                        <th class="px-6 py-3 ">Email</th>
                        <th class="px-6 py-3 ">Address</th>
                        <th class="px-6 py-3 ">User Type</th>
                        <th class="px-6 py-3 ">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4 ">{{ $user->id }}</td>
                        <td class="px-6 py-4 ">{{ $user->name }}</td>
                        <td class="px-6 py-4 ">{{ $user->email }}</td>
                        <td class="px-6 py-4 ">{{ $user->address }}</td>
                        <td class="px-6 py-4 ">{{ $user->usertype }}</td>
                        <td class="px-6 py-4 ">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 ">
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}"
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