<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $categories = Category::all();

    $books = Book::with('category');

    // filter by category
    if ($request->category_id) {
        $books->where('category_id', $request->category_id);
    }

    $books = $books->get();

    return view('books.index', compact('books', 'categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        
        $categories = Category::all();


        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'isbn'=> ['required', 'regex:/^[0-9\-]+$/'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_date' => 'required|date|before_or_equal:today',
            'content' => 'nullable|string',
        ],[
            'isbn.regex' => 'ISBN can only contain numbers and hyphens.',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('book_images', 'public');
        }

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
         $request->validate([
        'title' => 'required',
        'author' => 'required',
        'category_id' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'content' => 'nullable|string',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {

        // delete old image
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        // upload new image
        $data['image'] = $request->file('image')->store('books', 'public');
    }

    $book->update($data);

    return redirect()->route('books.index')
        ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
       if ($book->image) {
        Storage::disk('public')->delete($book->image);
    }

    $book->delete();

    return redirect()->route('admin.dashboard')
        ->with('success', 'Book deleted successfully.');
    }

    public function read(Book $book)
    {
        return view('books.read', compact('book'));
    }
}
