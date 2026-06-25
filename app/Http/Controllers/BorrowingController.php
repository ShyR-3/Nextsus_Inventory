<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Step 1: Form Pengajuan (Isi Data)
     */
    public function create(Asset $asset)
    {
        // Cek stok
        if ($asset->stock <= 0 || $asset->status !== 'available') {
            return back()->with('error', 'Aset tidak tersedia untuk dipinjam.');
        }

        return view('user.borrowing.create', compact('asset'));
    }

    /**
     * Step 2: Konfirmasi (Review sebelum submit)
     */
    public function confirm(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
            'notes' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        // Simpan data sementara di session
        session()->put('borrowing_data', array_merge($validated, [
            'asset_id' => $asset->id,
        ]));

        return view('user.borrowing.confirm', compact('asset', 'validated'));
    }

    /**
     * Step 3: Submit Peminjaman
     */
    public function store(Request $request, Asset $asset)
    {
        $data = session()->get('borrowing_data');

        if (!$data) {
            return redirect()->route('user.borrowing.create', $asset)
                ->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Cek stok lagi
        if ($asset->stock <= 0) {
            return back()->with('error', 'Stok aset habis.');
        }

        // Buat borrowing
        $borrowing = Borrowing::create([
            'user_id' => Auth::id(),
            'asset_id' => $asset->id,
            'borrow_date' => $data['borrow_date'],
            'return_date' => $data['return_date'],
            'status' => 'pending',
            'notes' => $data['notes'],
            'location' => $data['location'],
        ]);

        // Clear session
        session()->forget('borrowing_data');

        return view('user.borrowing.success', compact('borrowing', 'asset'));
    }

    /**
     * Halaman Riwayat Peminjaman User
     */
    public function history()
    {
        $borrowings = Borrowing::with('asset')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.borrowing.history', compact('borrowings'));
    }
}