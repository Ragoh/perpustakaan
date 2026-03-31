<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'book_id', 'loan_date', 'due_date', 'return_date',
        'duration', 'status', 'notes', 'admin_notes', 'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'loan_date' => 'date',
            'due_date' => 'date',
            'return_date' => 'date',
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
