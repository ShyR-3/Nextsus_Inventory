<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Asset;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard user dengan data aset
     */
    public function index()
    {
        // Ambil aset yang tersedia dari database (max 10)
        $assets = Asset::where('status', 'available')
                      ->where('stock', '>', 0)
                      ->latest()
                      ->take(10)
                      ->get();

        return view('user.dashboard', compact('assets'));
    }
}