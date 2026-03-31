<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\Review;

class ReportController extends Controller
{
    public function index()
    {
        $tab = request('tab', 'loans');
        $data = [];

        switch ($tab) {
            case 'loans':
                $data['loans'] = Loan::with(['user', 'book', 'approver'])->orderBy('created_at', 'desc')->paginate(15);
                break;
            case 'books':
                $data['books'] = Book::with('category')->withCount('loans')->withAvg('reviews', 'rating')->orderBy('created_at', 'desc')->paginate(15);
                $data['categories'] = Category::withCount('books')->orderBy('name')->get();
                break;
            case 'reviews':
                $data['reviews'] = Review::with(['user', 'book'])->orderBy('created_at', 'desc')->paginate(15);
                break;
        }

        return view('petugas.reports.index', array_merge(compact('tab'), $data));
    }

    public function preview()
    {
        $tab = request('tab', 'loans');

        switch ($tab) {
            case 'loans':
                $loans = Loan::with(['user', 'book', 'approver'])->orderBy('created_at', 'desc')->get();
                return view('exports.loans', compact('loans'));
            case 'books':
                $books = Book::with('category')->withCount('loans')->withAvg('reviews', 'rating')->orderBy('title')->get();
                $categories = Category::withCount('books')->orderBy('name')->get();
                return view('exports.books', compact('books', 'categories'));
            case 'reviews':
                $reviews = Review::with(['user', 'book'])->orderBy('created_at', 'desc')->get();
                return view('exports.reviews', compact('reviews'));
            default:
                return back()->with('error', 'Tab tidak valid.');
        }
    }
}
