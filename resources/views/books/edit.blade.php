<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8">
                    <!-- Form Header -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            {{ __('Edit Book Details') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ __('Update the book information below.') }}
                        </p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-red-800 dark:text-red-300">{{ __('Please correct the following errors:') }}</h3>
                                    <ul class="mt-2 text-sm text-red-700 dark:text-red-300 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>• {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('books.update', $book->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Book Title')" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2" />
                            <x-text-input
                                id="title"
                                class="block w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-lg shadow-sm"
                                type="text"
                                name="title"
                                :value="old('title', $book->title)"
                                required
                                autofocus
                                placeholder="Enter book title"
                            />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Author -->
                        <div>
                            <x-input-label for="author" :value="__('Author')" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2" />
                            <x-text-input
                                id="author"
                                class="block w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-lg shadow-sm"
                                type="text"
                                name="author"
                                :value="old('author', $book->author)"
                                required
                                placeholder="Enter author name"
                            />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2" />
                            <select
                                id="category_id"
                                name="category_id"
                                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-gray-900 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-lg shadow-sm"
                                required
                            >
                                <option value="">{{ __('Select a category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- ISBN -->
                        <div>
                            <x-input-label for="isbn" :value="__('ISBN')" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2" />
                            <x-text-input
                                id="isbn"
                                class="block w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-lg shadow-sm"
                                type="text"
                                name="isbn"
                                :value="old('isbn', $book->isbn)"
                                placeholder="Enter ISBN"
                            />
                            <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                        </div>

                        <!-- Published Date -->
                        <div>
                            <x-input-label for="published_date" :value="__('Published Date')" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2" />
                            <x-text-input
                                id="published_date"
                                class="block w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-lg shadow-sm"
                                type="date"
                                name="published_date"
                                :value="old('published_date', $book->published_date)"
                            />
                            <x-input-error :messages="$errors->get('published_date')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2" />
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-gray-900 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-lg shadow-sm"
                                placeholder="Enter book description"
                            >{{ old('description', $book->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-100 font-semibold rounded-lg hover:bg-gray-400 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button class="bg-yellow-600 hover:bg-yellow-700 dark:bg-yellow-500 dark:hover:bg-yellow-600">
                                {{ __('Update Book') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
