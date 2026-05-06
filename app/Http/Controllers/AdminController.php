<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard',  [
            'books' => \App\Models\Book::count(),
            'categories' => \App\Models\Category::count(),
            'users' => \App\Models\User::count(),
        ]);
    }
}
