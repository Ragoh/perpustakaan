<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Daftar peminjaman user
     */
    public function index()
    {
        $loans = Loan::with('book')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.loans.index', compact('loans'));
    }

    /**
     * Form pengajuan peminjaman
     */
    public function create($book_id)
    {
        $book = Book::findOrFail($book_id);

        if (!$book->is_available) {
            return back()->with('error', 'Buku ini sedang tidak tersedia.');
        }

        // Cek apakah user sudah punya peminjaman aktif untuk buku ini
        $existingLoan = Loan::where('user_id', auth()->id())
            ->where('book_id', $book_id)
            ->whereIn('status', ['pending', 'approved', 'borrowed'])
            ->first();

        if ($existingLoan) {
            return back()->with('error', 'Anda sudah memiliki peminjaman aktif untuk buku ini.');
        }

        return view('user.loans.create', compact('book'));
    }

    /**
     * Simpan pengajuan peminjaman
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'duration' => ['required', 'integer', 'in:7,14,21,30'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if (!$book->is_available) {
            return back()->with('error', 'Buku ini sedang tidak tersedia.');
        }

        $duration = (int) $validated['duration'];
        $loanDate = now();
        $dueDate = now()->addDays($duration);

        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $validated['book_id'],
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'duration' => $validated['duration'],
            'status' => 'pending',
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim. Tunggu persetujuan petugas.');
    }

    /**
     * Bukti peminjaman
     */
    public function receipt($id)
    {
        $loan = Loan::with(['user', 'book.category', 'approver'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.loans.receipt', compact('loan'));
    }

    /**
     * User mengembalikan buku sendiri
     */
    public function returnBook($id)
    {
        $loan = Loan::where('user_id', auth()->id())->findOrFail($id);

        if ($loan->status !== 'borrowed') {
            return back()->with('error', 'Peminjaman ini tidak dalam status dipinjam.');
        }

        $loan->update([
            'status' => 'return_pending',
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Pengajuan pengembalian berhasil dikirim. Tunggu konfirmasi petugas.');
    }
}
