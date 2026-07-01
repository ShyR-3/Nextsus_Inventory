<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset_id',
        'borrow_date',
        'return_date',
        'status',
        'notes',
        'location',
        'approved_at',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
        'approved_at' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Asset
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'borrowed' => 'bg-blue-100 text-blue-800',
            'returned' => 'bg-gray-100 text-gray-800',
        ];
        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Get status label in Indonesian
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'borrowed' => 'Sedang Dipinjam',
            'returned' => 'Dikembalikan',
        ];
        return $labels[$this->status] ?? $this->status;
    }
}