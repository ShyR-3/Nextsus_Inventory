<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\Asset;

class CatalogController extends Controller
{
    /**
     * Tampilkan katalog berdasarkan kategori
     */
    public function index($category = null)
    {
        // Daftar kategori yang tersedia
        $categories = [
            'hp-smartphone' => 'HP & Smartphone',
            'laptop' => 'Laptop',
            'kamera' => 'Kamera',
            'playstation' => 'Playstation',
        ];

        // Jika kategori tidak dipilih, redirect ke laptop (default)
        if (!$category) {
            $category = 'laptop';
        }

        // Ambil aset dari database berdasarkan kategori
        // Jika belum ada database, gunakan data dummy sementara
        if (class_exists('App\Models\Asset')) {
            $assets = Asset::where('category', $category)
                          ->where('status', 'Tersedia')
                          ->paginate(10);
        } else {
            // Data dummy untuk testing
            $assets = $this->getDummyAssets($category);
        }

        $categoryName = $categories[$category] ?? 'Semua Aset';

        return view('user.catalog', compact('assets', 'category', 'categoryName', 'categories'));
    }

    /**
     * Data dummy sementara (hapus setelah database siap)
     */
    private function getDummyAssets($category)
    {
        $dummyData = [
            'laptop' => [
                ['id' => 1, 'name' => 'HP Pavilion 14', 'stock' => 20, 'category' => 'laptop', 'image' => 'foto/HP Pavilion 14.png'],
                ['id' => 2, 'name' => 'ASUS ROG Strix', 'stock' => 15, 'category' => 'laptop', 'image' => 'foto/ASUS ROG Strix.png'],
                ['id' => 3, 'name' => 'ROG Flow X13', 'stock' => 17, 'category' => 'laptop', 'image' => 'foto/OG Flow X13.png'],
                ['id' => 4, 'name' => 'Acer Swift 3', 'stock' => 21, 'category' => 'laptop', 'image' => 'foto/Acer Swift 3.png'],
                ['id' => 5, 'name' => 'ASUS VIVOBOOK 14', 'stock' => 25, 'category' => 'laptop', 'image' => 'foto/ASUS VIVOBOOK 14.png'],
            ],
            'hp-smartphone' => [
                ['id' => 6, 'name' => 'iPhone 15 Pro Max 256 GB', 'stock' => 12, 'category' => 'hp-smartphone', 'image' => 'foto/iphone 15 pro max 256 gb.png'],
                ['id' => 7, 'name' => 'iPhone 14 Pro Max 256 GB', 'stock' => 15, 'category' => 'hp-smartphone', 'image' => 'foto/iphone 14 pro max 256 gb.png'],
                ['id' => 8, 'name' => 'Samsung Galaxy S25 Ultra', 'stock' => 20, 'category' => 'hp-smartphone', 'image' => 'foto/Samsung Galaxy S25 Ultra.png'],
                ['id' => 9, 'name' => 'Google Pixel 8 Pro', 'stock' => 18, 'category' => 'hp-smartphone', 'image' => 'foto/Google Pixel 8 Pro.png'],
                ['id' => 10, 'name' => 'vivo x300', 'stock' => 18, 'category' => 'hp-smartphone', 'image' => 'foto/vivo x300.png'],
               
            ],  
            'kamera' => [
                ['id' => 9, 'name' => 'Sony Alpha a6000', 'stock' => 20, 'category' => 'kamera', 'image' => 'foto/Sony Alpha a6000.png'],
                ['id' => 10, 'name' => 'Canon EOS M50', 'stock' => 23, 'category' => 'kamera', 'image' => 'foto/Canon EOS M50.png'],
                ['id' => 10, 'name' => 'sony a7iii', 'stock' => 23, 'category' => 'kamera', 'image' => 'foto/Sony A7III.png'],
                ['id' => 11, 'name' => 'Nikon D3500', 'stock' => 18, 'category' => 'kamera', 'image' => 'foto/Nikon D3500.png'],
                ['id' => 12, 'name' => 'Fujifilm X-T30', 'stock' => 22, 'category' => 'kamera', 'image' => 'foto/Fujifilm X-T30.png'],
            ],
            'playstation' => [
                ['id' => 11, 'name' => 'PlayStation 5 Standard', 'stock' => 5, 'category' => 'playstation', 'image' => 'foto/PlayStation 5 Standard.png'],
                ['id' => 12, 'name' => 'PlayStation 4 ', 'stock' => 3, 'category' => 'playstation', 'image' => 'foto/PlayStation 4.png'],
            ],
        ];

        $items = collect($dummyData[$category] ?? []);
$page = request()->get('page', 1);
$perPage = 10;

$currentPageItems = $items->slice(($page - 1) * $perPage, $perPage)->values();

return new LengthAwarePaginator(
    $currentPageItems,
    $items->count(),
    $perPage,
    $page,
    [
        'path' => request()->url(),
        'query' => request()->query(),
    ]
);
    }
}