<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'author', 'isbn', 'publisher',
        'year', 'pages', 'stock', 'description', 'cover', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Hitung rata-rata rating dari review
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Cek apakah stok buku tersedia
     */
    public function getIsAvailableAttribute()
    {
        $activeLoanCount = $this->loans()
            ->whereIn('status', ['approved', 'borrowed'])
            ->count();

        return $this->is_active && ($this->stock - $activeLoanCount) > 0;
    }

    /**
     * Hitung stok tersedia (total stok - sedang dipinjam)
     */
    public function getAvailableStockAttribute()
    {
        $activeLoanCount = $this->loans()
            ->whereIn('status', ['approved', 'borrowed'])
            ->count();

        return max(0, $this->stock - $activeLoanCount);
    }
}
