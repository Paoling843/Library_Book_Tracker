<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">🗂️ Categories</h1>
                <p class="text-sm text-gray-500">Manage your categories</p>
            </div>

            <a href="{{ route('categories.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                 Add Category
            </a
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <!-- Table Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h2 class="font-semibold text-gray-700">Category List</h2>
                <span class="text-sm text-gray-500">
                    Total: {{ $categories->count() }}
                </span>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 text-gray-500">
                                    #{{ $category->id }}
                                </td>

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $category->name }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('categories.destroy', $category) }}"
                                              onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-10 text-gray-500">
                                    No categories found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</body>
</html>