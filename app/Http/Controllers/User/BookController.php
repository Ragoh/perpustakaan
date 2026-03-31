<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Katalog buku
     */
    public function index()
    {
        $query = Book::with('category')
            ->where('is_active', true)
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        // Filter by category
        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        $books = $query->orderBy('created_at', 'desc')->paginate(12);

        $categories = Category::withCount('books')->orderBy('name')->get();

        return view('user.books.index', compact('books', 'categories'));
    }

    /**
     * Detail buku + reviews
     */
    public function show($id)
    {
        $book = Book::with(['category', 'reviews.user'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->findOrFail($id);

        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->where('is_active', true)
            ->withAvg('reviews', 'rating')
            ->limit(4)
            ->get();

        return view('user.books.show', compact('book', 'relatedBooks'));
    }
}
