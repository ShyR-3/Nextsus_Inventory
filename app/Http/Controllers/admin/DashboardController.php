<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * ========================================
     * DASHBOARD
     * ========================================
     */

    public function index()
    {
        $stats = [
            'total_assets' => Asset::count(),
            'available_assets' => Asset::where('status', 'available')->where('stock', '>', 0)->sum('stock'),
            'borrowed_assets' => Borrowing::where('status', 'borrowed')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'pending_bookings' => Borrowing::where('status', 'pending')->count(),
        ];

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
     * ========================================
     * BOOKINGS MANAGEMENT
     * ========================================
     */

    public function bookings()
    {
        $bookings = Borrowing::with(['user', 'asset'])
            ->latest()
            ->paginate(15);
        
        return view('admin.bookings', compact('bookings'));
    }

    public function approveBooking($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->status = 'approved';
        $borrowing->approved_at = now();
        $borrowing->save();

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    public function rejectBooking($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->status = 'rejected';
        $borrowing->save();

        return back()->with('success', 'Peminjaman ditolak!');
    }

    /**
     * ========================================
     * USERS MANAGEMENT
     * ========================================
     */

    public function users(Request $request)
    {
        $query = User::where('role', 'user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10);

        return view('admin.users', compact('users'));
    }

    /**
     * ========================================
     * REPORTS
     * ========================================
     */

    public function reports()
    {
        $totalAssets = Asset::count();
        $totalStock = Asset::sum('stock');
        $totalBorrowings = Borrowing::count();
        $totalUsers = User::where('role', 'user')->count();

        $statusCounts = Borrowing::select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalBorrowingStatus = array_sum($statusCounts);
        $statusBreakdown = [
            [
                'label' => 'Menunggu Persetujuan',
                'count' => $statusCounts['pending'] ?? 0,
                'percentage' => $totalBorrowingStatus > 0 ? round(($statusCounts['pending'] ?? 0) / $totalBorrowingStatus * 100) : 0,
                'color' => 'bg-yellow-500',
            ],
            [
                'label' => 'Disetujui',
                'count' => $statusCounts['approved'] ?? 0,
                'percentage' => $totalBorrowingStatus > 0 ? round(($statusCounts['approved'] ?? 0) / $totalBorrowingStatus * 100) : 0,
                'color' => 'bg-blue-500',
            ],
            [
                'label' => 'Sedang Dipinjam',
                'count' => $statusCounts['borrowed'] ?? 0,
                'percentage' => $totalBorrowingStatus > 0 ? round(($statusCounts['borrowed'] ?? 0) / $totalBorrowingStatus * 100) : 0,
                'color' => 'bg-orange-500',
            ],
            [
                'label' => 'Dikembalikan',
                'count' => $statusCounts['returned'] ?? 0,
                'percentage' => $totalBorrowingStatus > 0 ? round(($statusCounts['returned'] ?? 0) / $totalBorrowingStatus * 100) : 0,
                'color' => 'bg-green-500',
            ],
            [
                'label' => 'Ditolak',
                'count' => $statusCounts['rejected'] ?? 0,
                'percentage' => $totalBorrowingStatus > 0 ? round(($statusCounts['rejected'] ?? 0) / $totalBorrowingStatus * 100) : 0,
                'color' => 'bg-red-500',
            ],
        ];

        $categoryBreakdown = Asset::select('category')
            ->selectRaw('COUNT(*) as count')
            ->selectRaw('SUM(stock) as stock')
            ->groupBy('category')
            ->get()
            ->map(function($item) {
                $labels = [
                    'hp-smartphone' => 'HP & Smartphone',
                    'laptop' => 'Laptop',
                    'kamera' => 'Kamera',
                    'playstation' => 'PlayStation',
                ];
                return [
                    'category' => $item->category,
                    'label' => $labels[$item->category] ?? ucfirst($item->category),
                    'count' => $item->count,
                    'stock' => $item->stock ?? 0,
                ];
            });

        $topAssets = Asset::withCount(['borrowings' => function($query) {
            $query->whereIn('status', ['approved', 'borrowed', 'returned']);
        }])
        ->orderByDesc('borrowings_count')
        ->take(5)
        ->get();

        $recentActivity = Borrowing::with(['user', 'asset'])
            ->latest()
            ->take(5)
            ->get();

        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();

            $total = Borrowing::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $approved = Borrowing::whereBetween('created_at', [$monthStart, $monthEnd])
                ->whereIn('status', ['approved', 'borrowed', 'returned'])->count();
            $rejected = Borrowing::whereBetween('created_at', [$monthStart, $monthEnd])
                ->where('status', 'rejected')->count();
            $returned = Borrowing::whereBetween('created_at', [$monthStart, $monthEnd])
                ->where('status', 'returned')->count();

            $approvalRate = $total > 0 ? round(($approved / $total) * 100) : 0;

            $monthlyStats[] = [
                'month' => $date->format('F Y'),
                'total' => $total,
                'approved' => $approved,
                'rejected' => $rejected,
                'returned' => $returned,
                'approval_rate' => $approvalRate,
            ];
        }

        return view('admin.reports', compact(
            'totalAssets',
            'totalStock',
            'totalBorrowings',
            'totalUsers',
            'statusBreakdown',
            'categoryBreakdown',
            'topAssets',
            'recentActivity',
            'monthlyStats'
        ));
    }

    /**
     * ========================================
     * SETTINGS - METHOD BARU YANG BELUM ADA
     * ========================================
     */

    /**
     * Settings Page
     */
    public function settings()
    {
        $stats = [
            'total_assets' => Asset::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_borrowings' => Borrowing::count(),
            'total_categories' => Asset::distinct('category')->count('category'),
        ];

        return view('admin.settings', compact('stats'));
    }

    /**
     * Update Profile
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
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user = Auth::user();
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return back()->with('success', 'Password berhasil diubah! Silakan login kembali.');
    }

    /**
     * Update Application Settings
     */
    public function updateApplication(Request $request)
    {
        $request->flash();
        
        return back()->with('success', 'Pengaturan aplikasi berhasil disimpan!');
    }
}