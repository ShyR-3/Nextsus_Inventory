<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'specification',
        'stock',
        'status',
        'image',
        'price_per_day',
    ];

    protected $casts = [
        'stock' => 'integer',
        'price_per_day' => 'decimal:2',
    ];

    /**
     * ========================================
     * RELASI (RELATIONSHIPS)
     * ========================================
     */

    /**
     * Relasi ke Borrowing
     * Satu aset bisa memiliki banyak peminjaman
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * ========================================
     * SCOPES (QUERY SCOPES)
     * ========================================
     */

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope untuk aset yang tersedia
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->where('stock', '>', 0);
    }

    /**
     * ========================================
     * ACCESSORS & HELPERS
     * ========================================
     */

    /**
     * Cek apakah aset tersedia untuk dipinjam
     */
    public function isAvailable()
    {
        return $this->status === 'available' && $this->stock > 0;
    }

    /**
     * Helper: Dapatkan label status dalam bahasa Indonesia
     */
    public function getStatusLabelAttribute()
    {
        return [
            'available' => 'Tersedia',
            'unavailable' => 'Tidak Tersedia',
        ][$this->status] ?? $this->status;
    }

    /**
     * Helper: Dapatkan warna badge untuk status
     */
    public function getStatusColorAttribute()
    {
        return [
            'available' => 'bg-green-100 text-green-700',
            'unavailable' => 'bg-red-100 text-red-700',
        ][$this->status] ?? 'bg-gray-100 text-gray-700';
    }
}