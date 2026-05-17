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
                ['id' => 1, 'name' => 'HP Pavilion 14', 'stock' => 20, 'category' => 'laptop', 'image' => 'foto/laptop-1.png'],
                ['id' => 2, 'name' => 'ASUS ROG Strix', 'stock' => 15, 'category' => 'laptop', 'image' => 'foto/laptop-2.png'],
                ['id' => 3, 'name' => 'ROG Flow X13', 'stock' => 17, 'category' => 'laptop', 'image' => 'foto/laptop-3.png'],
                ['id' => 4, 'name' => 'Acer Swift 3', 'stock' => 21, 'category' => 'laptop', 'image' => 'foto/laptop-4.png'],
                ['id' => 5, 'name' => 'ASUS VIVOBOOK 14', 'stock' => 25, 'category' => 'laptop', 'image' => 'foto/laptop-5.png'],
            ],
            'hp-smartphone' => [
                ['id' => 6, 'name' => 'iPhone 15 Pro Max 256 GB', 'stock' => 12, 'category' => 'hp-smartphone', 'image' => 'foto/iphone15.png'],
                ['id' => 7, 'name' => 'iPhone 14 Pro Max 256 GB', 'stock' => 15, 'category' => 'hp-smartphone', 'image' => 'foto/iphone14.png'],
                ['id' => 8, 'name' => 'Samsung Galaxy S25 Ultra', 'stock' => 20, 'category' => 'hp-smartphone', 'image' => 'foto/s25ultra.png'],
                ['id' => 9, 'name' => 'Google Pixel 8 Pro', 'stock' => 18, 'category' => 'hp-smartphone', 'image' => 'foto/pixel8 pro.png'],
                ['id' => 10, 'name' => 'vivo x300', 'stock' => 18, 'category' => 'hp-smartphone', 'image' => 'foto/pixel8 pro.png'],
                ['id' => 11, 'name' => 'Xiaomi 17 Pro MAX', 'stock' => 20, 'category' => 'hp-smartphone', 'image' => 'foto/s25ultra.png'],
                ['id' => 12, 'name' => 'Realme GT Neo 5', 'stock' => 18, 'category' => 'hp-smartphone', 'image' => 'foto/pixel8 pro.png'],
                ['id' => 8, 'name' => 'huawei pura 80 ultra', 'stock' => 20, 'category' => 'hp-smartphone', 'image' => 'foto/s25ultra.png'],
            ],  
            'kamera' => [
                ['id' => 9, 'name' => 'Sony Alpha a6000', 'stock' => 20, 'category' => 'kamera', 'image' => 'foto/camera-1.png'],
                ['id' => 10, 'name' => 'Canon EOS M50', 'stock' => 23, 'category' => 'kamera', 'image' => 'foto/camera-2.png'],
                ['id' => 10, 'name' => 'Canon EOS M50', 'stock' => 23, 'category' => 'kamera', 'image' => 'foto/camera-2.png'],
                ['id' => 11, 'name' => 'Nikon D3500', 'stock' => 18, 'category' => 'kamera', 'image' => 'foto/camera-3.png'],
                ['id' => 12, 'name' => 'Fujifilm X-T30', 'stock' => 22, 'category' => 'kamera', 'image' => 'foto/camera-4.png'],
            ],
            'playstation' => [
                ['id' => 11, 'name' => 'PlayStation 5 Standard', 'stock' => 5, 'category' => 'playstation', 'image' => 'foto/ps-1.png'],
                ['id' => 12, 'name' => 'PlayStation 5 Digital', 'stock' => 3, 'category' => 'playstation', 'image' => 'foto/ps-2.png'],
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