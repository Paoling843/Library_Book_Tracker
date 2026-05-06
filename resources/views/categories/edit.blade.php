<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Category</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST"
              action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            <input type="text"
                   name="name"
                   value="{{ $category->name }}"
                   class="border p-2 w-full">

            <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>

    </div>
</x-app-layout>