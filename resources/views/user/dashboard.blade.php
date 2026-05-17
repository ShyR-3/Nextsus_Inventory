<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Nexus Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nexus: {
                            dark: '#0D1F0D',      // Sidebar & Banner
                            main: '#1B3A1B',      // Cards hijau
                            light: '#2E5C2E',     // Accent
                            accent: '#E8F5E9',    // Tombol
                            green: '#1B5E20',     // Primary green
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        ::-webkit-scrollbar { display: none; }
        body { -ms-overflow-style: none; scrollbar-width: none; }
        .truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-200 text-gray-800 h-screen overflow-hidden">

    <div class="flex h-screen">
        
        <!-- ================= SIDEBAR ================= -->
        <aside class="w-64 bg-gradient-to-b from-nexus-dark to-black text-white flex flex-col flex-shrink-0">
            <div class="p-6 flex items-center gap-3 border-b border-white/10">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-nexus-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold tracking-wide">NEXUS</div>
                    <div class="text-[10px] tracking-widest opacity-80">INVENTORY</div>
                </div>
            </div>

            <nav class="px-4 space-y-1 mt-4 flex-1 overflow-y-auto">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-lg text-white font-medium">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Beranda
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-sm">peminjaman</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <span class="text-sm">Ajukan peminjaman</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm">Riwayat peminjaman</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="text-sm">Notifikasi</span>
                </a>

                <div class="px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Aset</div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    <span class="text-sm">Katalog aset</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span class="text-sm">Aset saya</span>
                </a>

                <div class="px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Lainnya</div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-sm">Pengaturan</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span class="text-sm">Bantuan</span>
                </a>
            </nav>
        </aside>

        <!-- ================= MAIN CONTENT ================= -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- HEADER (Search) -->
            <header class="bg-gray-300 p-3 flex items-center gap-4 flex-shrink-0">
                <div class="flex-1 bg-nexus-green rounded-full px-5 py-3 flex items-center gap-3">
                    <span class="text-white text-sm font-medium flex-1">Cari, aset, kategori, dan merek........</span>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </header>

            <!-- CONTENT AREA -->
            <div class="flex-1 overflow-hidden p-4 space-y-4">
                
                <!-- HERO BANNER -->
                <div class="bg-gradient-to-r from-nexus-dark to-black rounded-2xl p-6 flex items-center justify-between text-white flex-shrink-0">
                    <div class="max-w-md">
                        <h2 class="text-2xl font-bold mb-1 leading-tight">Sistem Peminjaman Aset<br><span class="text-3xl">Nexus Inventory</span></h2>
                        <p class="text-gray-300 text-sm mt-3">Pinjam aset yang anda butuhkan untuk<br>mendukung pekerjaan dan kegiatan anda</p>
                    </div>
                    <div class="hidden md:flex items-end gap-2">
                        <img src="{{ asset('foto/hero-laptop.png') }}" class="w-24 drop-shadow-2xl transform -rotate-12">
                        <img src="{{ asset('foto/hero-camera.png') }}" class="w-32 drop-shadow-2xl">
                        <img src="{{ asset('foto/hero-phone.png') }}" class="w-24 drop-shadow-2xl transform rotate-6">
                        <img src="{{ asset('foto/hero-ps.png') }}" class="w-28 drop-shadow-2xl transform rotate-12">
                    </div>
                </div>

                <!-- CATEGORY CARDS (4 Horizontal) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 flex-shrink-0">
                    @php
                    
    $categories = [
        ['name' => 'HP & Smartphone', 'slug' => 'hp-smartphone', 'desc' => 'Berbagai pilihan Hp terbaru dan berkualitas', 'assets' => 'foto/phone-1.png'],
        ['name' => 'Laptop', 'slug' => 'laptop', 'desc' => 'Laptop untuk bekerja, belajar dan lain lain', 'assets' => 'foto/laptop-1.png'],
        ['name' => 'Kamera', 'slug' => 'kamera', 'desc' => 'Kamera yang berkualiatas dan canggih', 'assets' => 'foto/camera-1.png'],
        ['name' => 'Playstation', 'slug' => 'playstation', 'desc' => 'konsuk gaming untuk hiburan dan event', 'assets' => 'foto/ps-1.png'],
    ];
@endphp
                    
                    
@foreach($categories as $cat)
<div class="bg-nexus-green rounded-2xl p-5 text-white flex flex-col items-start relative overflow-hidden shadow-lg">
    <h4 class="text-sm font-semibold mb-2">{{ $cat['name'] }}</h4>
    <p class="text-[11px] text-gray-200 leading-tight mb-3 max-w-[60%]">{{ $cat['desc'] }}</p>
    
    <!-- LINK KE KATALOG -->
    <a href="{{ route('katalog.category', $cat['slug']) }}" 
       class="bg-white text-nexus-green text-[10px] font-bold py-1.5 px-4 rounded-full hover:bg-gray-100 transition z-10 inline-block">
       LIHAT ASET
    </a>
    
    <img src="{{ asset($cat['assets']) }}" class="absolute -bottom-2 -right-2 w-28 h-28 object-contain drop-shadow-xl">
</div>
@endforeach
                </div>

                <!-- ASET TERSEDIA SECTION -->
                <div class="flex-1 overflow-hidden">
                    <h3 class="text-xl font-bold text-gray-700 mb-3 text-center">Aset Tersedia</h3>
                    <h4 class="text-base font-semibold text-gray-600 mb-3">HP & Smartphone</h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @php
                            $phones = [
                                ['name' => 'iPhone 15 pro max 256 GB', 'stock' => 12, 'img' => 'foto/iphone15.png'],
                                ['name' => 'iPhone 14 pro max 256 GB', 'stock' => 15, 'img' => 'foto/iphone14.png'],
                                ['name' => 'iPhone 17 pro max 256 GB', 'stock' => 10, 'img' => 'foto/iphone17.png'],
                                ['name' => 'Samsung Galaxy Z Flip7 FE 256Gb 5G White', 'stock' => 12, 'img' => 'foto/zflip.png'],
                                ['name' => 'Samsung Galaxy S25 Ultra 5G Galaxy 256GB', 'stock' => 20, 'img' => 'foto/s25ultra.png'],
                            ];
                        @endphp
                        @foreach($phones as $item)
                        <div class="bg-nexus-main rounded-2xl p-3 text-white flex flex-col items-center text-center shadow-lg">
                            <span class="bg-white text-nexus-main text-[10px] font-bold px-3 py-1 rounded-lg self-start mb-2">Tersedia</span>
                            <img src="{{ asset($item['img']) }}" class="w-full h-32 object-contain mb-2 drop-shadow-lg">
                            <p class="text-xs font-semibold text-white mb-1 leading-tight px-1">{{ $item['name'] }}</p>
                            <p class="text-[10px] text-gray-200 leading-tight">stock tersedia {{ $item['stock'] }} unit<br>minimal pinjam 1 hari</p>
                            <button class="mt-2 bg-nexus-accent text-nexus-dark text-[10px] font-bold py-1.5 px-3 rounded-lg hover:bg-white transition w-full">Ajukan peminjaman</button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- FOOTER (Pagination) -->
            <footer class="bg-nexus-green text-white px-6 py-3 flex items-center justify-between text-sm flex-shrink-0">
                <span class="text-gray-200">menampilkan 1-4</span>
                <div class="flex items-center gap-1">
                    <button class="p-1 hover:bg-white/20 rounded"></button>
                    <button class="px-3 py-1 bg-white/20 rounded text-xs font-bold">1</button>
                    <button class="px-3 py-1 hover:bg-white/20 rounded text-xs">2</button>
                    <button class="px-3 py-1 hover:bg-white/20 rounded text-xs">3</button>
                    <button class="px-3 py-1 hover:bg-white/20 rounded text-xs">4</button>
                    <button class="p-1 hover:bg-white/20 rounded">▶</button>
                </div>
            </footer>

        </main>
    </div>

</body>
</html>