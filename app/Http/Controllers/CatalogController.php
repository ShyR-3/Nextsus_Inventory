<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Tampilkan katalog semua aset
     */
    public function index(Request $request)
    {
        $query = Asset::where('status', 'available')
                      ->where('stock', '>', 0);

        // Filter berdasarkan kategori jika ada
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search jika ada
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('specification', 'like', '%' . $request->search . '%');
        }

        $assets = $query->latest()->paginate(12);
        $categories = Asset::select('category')->distinct()->get();

        return view('user.catalog', compact('assets', 'categories'));
    }

    /**
     * Tampilkan katalog berdasarkan kategori
     */
    public function category($categoryName)
    {
        $assets = Asset::where('category', $categoryName)
                      ->where('status', 'available')
                      ->where('stock', '>', 0)
                      ->latest()
                      ->paginate(12);

        $categories = Asset::select('category')->distinct()->get();
        $categoryNameLabel = $this->getCategoryName($categoryName);

        return view('user.catalog', compact('assets', 'categories', 'categoryNameLabel'));
    }

    /**
     * Helper: Dapatkan nama kategori dalam bahasa Indonesia
     */
    private function getCategoryName($slug)
    {
        $categories = [
            'hp-smartphone' => 'HP & Smartphone',
            'laptop' => 'Laptop',
            'kamera' => 'Kamera',
            'playstation' => 'PlayStation',
        ];

        return $categories[$slug] ?? ucfirst($slug);
    }
}