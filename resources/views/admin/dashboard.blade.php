<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100">
                    Admin Dashboard
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Welcome back, {{ auth()->user()->name }} 👋
                </p>
            </div>
            <span class="text-xs text-gray-400 dark:text-gray-500">
                {{ now()->format('l, F j, Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ── Stat Cards ── --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                {{-- Books --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 flex items-center gap-5 border-l-4 border-blue-500">
                    <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-xl text-blue-600 dark:text-blue-300 text-2xl">
                        📚
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">
                            Total Books
                        </p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">
                            {{ \App\Models\Book::count() }}
                        </p>
                    </div>
                </div>

                {{-- Categories --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 flex items-center gap-5 border-l-4 border-green-500">
                    <div class="bg-green-100 dark:bg-green-900 p-4 rounded-xl text-green-600 dark:text-green-300 text-2xl">
                        🗂️
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">
                            Categories
                        </p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">
                            {{ \App\Models\Category::count() }}
                        </p>
                    </div>
                </div>

                {{-- Users --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 flex items-center gap-5 border-l-4 border-purple-500">
                    <div class="bg-purple-100 dark:bg-purple-900 p-4 rounded-xl text-purple-600 dark:text-purple-300 text-2xl">
                        👥
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">
                            Users
                        </p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">
                            {{ \App\Models\User::count() }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- ── Quick Actions ── --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4">
                    Quick Actions
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <a href="{{ route('books.index') }}"
                       class="flex items-center gap-3 bg-blue-600 hover:bg-blue-700 active:scale-95 transition-all text-white px-5 py-4 rounded-2xl shadow font-medium">
                        <span class="text-xl">📚</span> Manage Books
                    </a>

                    <a href="{{ route('books.create') }}"
                       class="flex items-center gap-3 bg-green-600 hover:bg-green-700 active:scale-95 transition-all text-white px-5 py-4 rounded-2xl shadow font-medium">
                        <span class="text-xl">➕</span> Add New Book
                    </a>

                    {{-- Add more actions as your app grows --}}
                    <a href="{{ route('categories.index') }}"
                       class="flex items-center gap-3 bg-yellow-500 hover:bg-yellow-600 active:scale-95 transition-all text-white px-5 py-4 rounded-2xl shadow font-medium">
                        <span class="text-xl">🗂️</span> Categories
                    </a>

                    <a href="{{ route('users.index') }}"
                       class="flex items-center gap-3 bg-purple-600 hover:bg-purple-700 active:scale-95 transition-all text-white px-5 py-4 rounded-2xl shadow font-medium">
                        <span class="text-xl">👥</span> Manage Users
                    </a>

                </div>
            </div>

            {{-- ── Recent Books ── --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-200">
                        Recently Added Books
                    </h3>
                    <a href="{{ route('books.index') }}"
                       class="text-sm text-blue-500 hover:underline">
                        View all →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-3 text-left">#</th>
                                <th class="px-6 py-3 text-left">Title</th>
                                <th class="px-6 py-3 text-left">Category</th>
                                <th class="px-6 py-3 text-left">Added</th>
                                <th class="px-6 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse(\App\Models\Book::with('category')->latest()->take(5)->get() as $i => $book)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors">
                                    <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-100">
                                        {{ $book->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $book->category->name ?? '—' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400">
                                        {{ $book->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('books.edit', $book) }}"
                                           class="text-xs bg-yellow-100 text-yellow-700 hover:bg-yellow-200 px-3 py-1 rounded-full font-medium transition">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('books.destroy', $book) }}"
                                              onsubmit="return confirm('Delete this book?')">
                                            @csrf @method('DELETE')
                                            <button class="text-xs bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1 rounded-full font-medium transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                        No books added yet.
                                        <a href="{{ route('books.create') }}" class="text-blue-500 hover:underline ml-1">
                                            Add the first one →
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>