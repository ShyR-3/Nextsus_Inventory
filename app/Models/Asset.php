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
        'status',  // ✅ Sekarang hanya: available / unavailable
        'image',
    ];

    protected $casts = [
        'stock' => 'integer',
    ];

    /**
     * Helper: Cek apakah aset tersedia
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