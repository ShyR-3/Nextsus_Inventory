<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\User;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function index()
    {
        // ✅ STATS REALTIME DARI DATABASE
        $stats = [
            'total_assets' => Asset::count(),
            'available_assets' => Asset::where('status', 'available')->where('stock', '>', 0)->sum('stock'),
            'borrowed_assets' => Borrowing::where('status', 'borrowed')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'pending_bookings' => Borrowing::where('status', 'pending')->count(),
        ];

        // Recent bookings (jika ada)
        $recentBookings = Borrowing::with(['user', 'asset'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($booking) {
                return [
                    'id' => $booking->id,
                    'user' => $booking->user->name ?? 'Unknown',
                    'asset' => $booking->asset->name ?? 'Unknown',
                    'date' => $booking->borrow_date->format('d M Y'),
                    'status' => ucfirst($booking->status),
                ];
            });

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }

    /**
     * Bookings Management
     */
    public function bookings()
    {
        $bookings = Borrowing::with(['user', 'asset'])
            ->latest()
            ->paginate(15);
        
        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Approve Booking
     */
    public function approveBooking($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    /**
     * Reject Booking
     */
    public function rejectBooking($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update(['status' => 'rejected']);

        return back()->with('success', 'Peminjaman ditolak!');
    }

    /**
     * Users Management
     */
    public function users()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Reports Page
     */
    public function reports()
    {
        return back()->with('info', 'Fitur laporan sedang dalam pengembangan.');
    }
}