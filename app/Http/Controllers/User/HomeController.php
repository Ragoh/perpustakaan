<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Stats dari database
        $totalBooks = Book::sum('stock');
        $totalCategories = Category::count();
        $totalMembers = User::where('role', 'user')->where('is_active', true)->count();

        // Buku populer (paling banyak dipinjam, max 8)
        $popularBooks = Book::with('category')
            ->withCount('loans')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('loans_count')
            ->take(8)
            ->get();

        // Kategori dengan jumlah buku
        $categories = Category::withCount('books')
            ->orderByDesc('books_count')
            ->take(6)
            ->get();

        // Gradient colors untuk kategori
        $gradients = [
            'from-blue-500 to-blue-600',
            'from-green-500 to-green-600',
            'from-purple-500 to-purple-600',
            'from-amber-500 to-amber-600',
            'from-indigo-500 to-indigo-600',
            'from-pink-500 to-pink-600',
        ];

        return view('user.index', compact(
            'totalBooks', 'totalCategories', 'totalMembers',
            'popularBooks', 'categories', 'gradients'
        ));
    }
}
