<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Daftar semua peminjaman
     */
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'asset']);

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $borrowings = $query->latest()->paginate(15);

        $stats = [
            'pending' => Borrowing::where('status', 'pending')->count(),
            'approved' => Borrowing::where('status', 'approved')->count(),
            'borrowed' => Borrowing::where('status', 'borrowed')->count(),
            'returned' => Borrowing::where('status', 'returned')->count(),
            'rejected' => Borrowing::where('status', 'rejected')->count(),
        ];

        return view('admin.borrowings.index', compact('borrowings', 'stats'));
    }

    /**
     * Approve peminjaman
     */
    public function approve($id)
    {
        $borrowing = Borrowing::with('asset')->findOrFail($id);

        // Cek stok
        if ($borrowing->asset->stock <= 0) {
            return back()->with('error', 'Stok aset habis, tidak bisa disetujui.');
        }

        $borrowing->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        // Kurangi stok
        $borrowing->asset->decrement('stock', 1);

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    /**
     * Reject peminjaman
     */
    public function reject($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update(['status' => 'rejected']);

        return back()->with('success', 'Peminjaman ditolak.');
    }

    /**
     * Tandai sebagai dipinjam
     */
    public function markAsBorrowed($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update(['status' => 'borrowed']);

        return back()->with('success', 'Status diubah menjadi sedang dipinjam.');
    }

    /**
     * Tandai sebagai dikembalikan
     */
    public function markAsReturned($id)
    {
        $borrowing = Borrowing::with('asset')->findOrFail($id);
        $borrowing->update(['status' => 'returned']);

        // Kembalikan stok
        $borrowing->asset->increment('stock', 1);

        return back()->with('success', 'Aset berhasil dikembalikan. Stok diperbarui.');
    }
}