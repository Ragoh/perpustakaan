<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Simpan ulasan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        // Cek apakah user pernah meminjam buku ini dan sudah dikembalikan
        $hasReturned = Loan::where('user_id', auth()->id())
            ->where('book_id', $validated['book_id'])
            ->where('status', 'returned')
            ->exists();

        if (!$hasReturned) {
            return back()->with('error', 'Anda hanya bisa memberi ulasan setelah mengembalikan buku.');
        }

        // Cek apakah sudah pernah review
        $existing = Review::where('user_id', auth()->id())
            ->where('book_id', $validated['book_id'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk buku ini.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'book_id' => $validated['book_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('books.show', $validated['book_id'])
            ->with('success', 'Ulasan berhasil ditambahkan. Terima kasih!');
    }
}
