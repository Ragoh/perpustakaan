<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    const FINE_PER_DAY = 1000; // Rp 1.000 per hari keterlambatan

    protected $fillable = [
        'user_id', 'book_id', 'loan_date', 'due_date', 'return_date',
        'duration', 'status', 'notes', 'admin_notes', 'approved_by',
        'fine_amount', 'fine_paid', 'fine_paid_at', 'fine_confirmed_by',
    ];

    protected function casts(): array
    {
        return [
            'loan_date' => 'date',
            'due_date' => 'date',
            'return_date' => 'date',
            'fine_amount' => 'decimal:2',
            'fine_paid' => 'boolean',
            'fine_paid_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function fineConfirmer()
    {
        return $this->belongsTo(User::class, 'fine_confirmed_by');
    }

    /**
     * Cek apakah peminjaman sudah lewat batas
     */
    public function getIsOverdueAttribute()
    {
        return !$this->return_date 
            && in_array($this->status, ['borrowed']) 
            && $this->due_date->isPast();
    }

    /**
     * Hitung jumlah hari terlambat
     */
    public function getOverdueDaysAttribute()
    {
        if ($this->status === 'returned' && $this->return_date && $this->return_date->gt($this->due_date)) {
            return $this->due_date->diffInDays($this->return_date);
        }

        if ($this->is_overdue) {
            return $this->due_date->diffInDays(now());
        }

        return 0;
    }

    /**
     * Hitung denda secara dinamis (untuk yang belum di-finalize)
     */
    public function getCalculatedFineAttribute()
    {
        return $this->overdue_days * self::FINE_PER_DAY;
    }

    /**
     * Apakah ada denda yang belum dibayar
     */
    public function getHasUnpaidFineAttribute()
    {
        return $this->fine_amount > 0 && !$this->fine_paid;
    }

    /**
     * Format denda dalam Rupiah
     */
    public function getFormattedFineAttribute()
    {
        return 'Rp ' . number_format($this->fine_amount, 0, ',', '.');
    }

    /**
     * Label status untuk ditampilkan
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui - Silakan Ambil',
            'rejected' => 'Ditolak',
            'borrowed' => $this->is_overdue ? 'Terlambat' : 'Sedang Dipinjam',
            'return_pending' => 'Menunggu Konfirmasi Pengembalian',
            'returned' => 'Sudah Dikembalikan',
            default => $this->status,
        };
    }

    /**
     * Tipe badge untuk status
     */
    public function getStatusTypeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'approved' => 'info',
            'rejected' => 'error',
            'borrowed' => $this->is_overdue ? 'error' : 'primary',
            'return_pending' => 'warning',
            'returned' => 'success',
            default => 'default',
        };
    }
}
