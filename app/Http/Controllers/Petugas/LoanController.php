<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Daftar semua peminjaman
     */
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'book'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->paginate(10);

        return view('petugas.loans.index', compact('loans'));
    }

    /**
     * Detail peminjaman
     */
    public function show($id)
    {
        $loan = Loan::with(['user', 'book', 'approver'])->findOrFail($id);
        return view('petugas.loans.show', compact('loan'));
    }

    /**
     * Approve peminjaman
     */
    public function approve(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini tidak dalam status menunggu persetujuan.');
        }

        $loan->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', "Peminjaman #{$loan->id} berhasil disetujui.");
    }

    /**
     * Reject peminjaman
     */
    public function reject(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini tidak dalam status menunggu persetujuan.');
        }

        $request->validate([
            'admin_notes' => ['required', 'string'],
        ]);

        $loan->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', "Peminjaman #{$loan->id} ditolak.");
    }

    /**
     * Tandai buku sudah diambil (borrowed)
     */
    public function markBorrowed($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status !== 'approved') {
            return back()->with('error', 'Peminjaman ini belum disetujui.');
        }

        $loan->update(['status' => 'borrowed']);

        return back()->with('success', "Buku berhasil ditandai sebagai dipinjam.");
    }

    /**
     * Approve pengembalian buku
     * Hitung denda jika terlambat
     */
    public function approveReturn($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status !== 'return_pending') {
            return back()->with('error', 'Peminjaman ini tidak dalam status menunggu konfirmasi pengembalian.');
        }

        $returnDate = now();
        $fineAmount = 0;

        // Hitung denda jika terlambat
        if ($returnDate->gt($loan->due_date)) {
            $overdueDays = $loan->due_date->diffInDays($returnDate);
            $fineAmount = $overdueDays * Loan::FINE_PER_DAY;
        }

        if ($fineAmount > 0) {
            // Ada denda — simpan tapi belum selesai, tunggu pembayaran
            $loan->update([
                'return_date' => $returnDate,
                'fine_amount' => $fineAmount,
                'fine_paid' => false,
                'status' => 'returned',
            ]);

            $formattedFine = 'Rp ' . number_format($fineAmount, 0, ',', '.');
            return back()->with('success', "Pengembalian #{$loan->id} dikonfirmasi. Denda keterlambatan: {$formattedFine}. Menunggu pembayaran di perpustakaan.");
        }

        // Tidak ada denda
        $loan->update([
            'status' => 'returned',
            'return_date' => $returnDate,
            'fine_amount' => 0,
            'fine_paid' => true,
        ]);

        return back()->with('success', "Pengembalian #{$loan->id} berhasil dikonfirmasi. Tidak ada denda.");
    }

    /**
     * Reject pengembalian buku (kembali ke borrowed)
     */
    public function rejectReturn($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->status !== 'return_pending') {
            return back()->with('error', 'Peminjaman ini tidak dalam status menunggu konfirmasi pengembalian.');
        }

        $loan->update([
            'status' => 'borrowed',
        ]);

        return back()->with('success', "Pengembalian #{$loan->id} ditolak, status kembali ke dipinjam.");
    }

    /**
     * Konfirmasi denda sudah dibayar (petugas)
     */
    public function confirmFinePaid($id)
    {
        $loan = Loan::findOrFail($id);

        if ($loan->fine_amount <= 0 || $loan->fine_paid) {
            return back()->with('error', 'Tidak ada denda yang perlu dikonfirmasi.');
        }

        $loan->update([
            'fine_paid' => true,
            'fine_paid_at' => now(),
            'fine_confirmed_by' => auth()->id(),
        ]);

        return back()->with('success', "Pembayaran denda #{$loan->id} sebesar {$loan->formatted_fine} berhasil dikonfirmasi.");
    }
}
