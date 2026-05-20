<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Nanti import model database di sini:
// use App\Models\Asset;
// use App\Models\Booking;
// use App\Models\User;

class DashboardController extends Controller
{
    /**
     * 1. Dashboard Utama
     */
    public function index()
    {
        // Statistik sementara (dummy)
        $stats = [
            'total_assets' => 150,
            'available_assets' => 120,
            'borrowed_assets' => 30,
            'total_users' => 45,
            'pending_bookings' => 0,
            'approved_bookings' => 0,
        ];

        // Tabel kosong (data sudah dihapus sesuai permintaan)
        $recentBookings = [];

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }

    /**
     * 2. Halaman Daftar Aset
     */
    public function assets()
    {
        return view('admin.assets'); // Nanti buat file view-nya
    }

    /**
     * 3. Simpan Aset Baru
     */
    public function storeAsset(Request $request)
    {
        // Validasi & simpan ke database nanti di sini
        return back()->with('success', 'Aset berhasil ditambahkan!');
    }

    /**
     * 4. Halaman Daftar Peminjaman
     */
    public function bookings()
    {
        return view('admin.bookings');
    }

    /**
     * 5. Approve Peminjaman
     */
    public function approveBooking($id)
    {
        // Update status booking ke 'Approved' nanti di sini
        return back()->with('success', 'Peminjaman disetujui!');
    }

    /**
     * 6. Reject Peminjaman
     */
    public function rejectBooking($id)
    {
        // Update status booking ke 'Rejected' nanti di sini
        return back()->with('error', 'Peminjaman ditolak!');
    }

    /**
     * 7. Halaman Kelola User
     */
    public function users()
    {
        return view('admin.users');
    }
}