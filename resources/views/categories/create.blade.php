<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Category</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <input type="text"
                   name="name"
                   placeholder="Category Name"
                   class="border p-2 w-full">

            <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>

    </div>
</x-app-layout>