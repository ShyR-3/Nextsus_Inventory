<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // ✅ TAMBAHKAN INI

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

    /**
     * ========================================
     * ASET SAYA (MY ASSETS) - UNTUK USER
     * ========================================
     */

    /**
     * Menampilkan daftar aset yang sedang aktif dipinjam user
     */
    public function myAssets()
    {
        // Ambil peminjaman dengan status aktif (approved atau borrowed)
        $activeBorrowings = Borrowing::with('asset')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'borrowed'])
            ->orderByRaw("FIELD(status, 'borrowed', 'approved')")
            ->orderBy('borrow_date', 'desc')
            ->get();

        // Statistik
        $stats = [
            'total_active' => $activeBorrowings->count(),
            'approved' => $activeBorrowings->where('status', 'approved')->count(),
            'borrowed' => $activeBorrowings->where('status', 'borrowed')->count(),
            'overdue' => $activeBorrowings->where('return_date', '<', now())->count(),
        ];

        return view('user.assets.index', compact('activeBorrowings', 'stats'));
    }

    /**
     * ========================================
     * PENGEMBALIAN ASET (RETURNS)
     * ========================================
     */

    /**
     * Menampilkan daftar aset yang perlu dikembalikan
     */
    public function returns()
    {
        // Ambil peminjaman dengan status borrowed yang perlu dikembalikan
        $returns = Borrowing::with('asset')
            ->where('user_id', Auth::id())
            ->where('status', 'borrowed')
            ->orderBy('return_date', 'asc')
            ->get();

        // Statistik
        $stats = [
            'total' => $returns->count(),
            'due_today' => $returns->where('return_date', '=', now()->format('Y-m-d'))->count(),
            'overdue' => $returns->where('return_date', '<', now())->count(),
            'upcoming' => $returns->where('return_date', '>', now())->count(),
        ];

        return view('user.returns.index', compact('returns', 'stats'));
    }

    /**
     * Konfirmasi pengembalian aset oleh user
     */
    public function confirmReturn($id)
    {
        $borrowing = Borrowing::with('asset')->findOrFail($id);

        // Validasi: hanya user yang bersangkutan yang bisa konfirmasi
        if ($borrowing->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk aset ini.');
        }

        // Validasi: status harus borrowed
        if ($borrowing->status !== 'borrowed') {
            return back()->with('error', 'Aset ini tidak dalam status dipinjam.');
        }

        // Update status menjadi returned (stok akan ditambah oleh admin saat verifikasi)
        $borrowing->update([
            'status' => 'returned',
            'returned_at' => now(),
        ]);

        return back()->with('success', 'Pengembalian aset berhasil dikonfirmasi! Silakan serahkan aset ke admin.');
    }

    /**
     * ========================================
     * PENGATURAN USER (SETTINGS)
     * ========================================
     */

    /**
     * Menampilkan halaman pengaturan user
     */
    public function settings()
    {
        return view('user.settings.index');
    }

    /**
     * Update profil user
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? $user->phone;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Check current password
        if (!Hash::check($validated['current_password'], Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        // Update password
        $user = Auth::user();
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Update preferensi notifikasi
     */
    public function updateNotifications(Request $request)
    {
        $validated = $request->validate([
            'email_notifications' => 'nullable|boolean',
            'sms_notifications' => 'nullable|boolean',
            'borrowing_reminder' => 'nullable|boolean',
            'return_reminder' => 'nullable|boolean',
        ]);

        // Simpan ke database atau session (sesuai kebutuhan)
        // Contoh: simpan ke user meta atau settings table
        session()->put('user_notifications', $validated);

        return back()->with('success', 'Preferensi notifikasi berhasil diperbarui!');
    }
}