<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $books = Book::get();
        // dd(123);
        $data = [
            'books' => $books,
            'count' => 5,
            'title' => 'Midnight',
        ];

        return Inertia::render('Test', [
            'response' => $data,
        ]);
    }

    public function create() {

    }
}
