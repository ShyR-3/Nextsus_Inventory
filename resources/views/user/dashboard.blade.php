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
                            dark: '#0D1F0D',
                            main: '#1B3A1B',
                            green: '#1B5E20',
                            light: '#2E7D32',
                            accent: '#E8F5E9',
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
        .gradient-hero {
            background: linear-gradient(135deg, #0D1F0D 0%, #1B3A1B 100%);
        }
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="bg-gray-200 text-gray-800 h-screen overflow-hidden">

    <div class="flex h-screen">
        
        <!-- ================= SIDEBAR ================= -->
        <aside class="w-64 bg-gradient-to-b from-nexus-dark to-black text-white flex flex-col flex-shrink-0">
            
            <!-- Logo -->
            <div class="p-6 flex items-center justify-center border-b border-white/10">
                <img src="{{ asset('foto/logo.png') }}" alt="Nexus Inventory" class="h-16 w-auto">
            </div>

            <!-- Navigation -->
            <nav class="px-3 py-4 space-y-1 flex-1 overflow-y-auto">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Menu Utama</div>
                
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('user/dashboard') ? 'bg-white text-nexus-dark font-semibold rounded-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-sm">Beranda</span>
                </a>
                
                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">peminjaman</div>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span class="text-sm">Ajukan peminjaman</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm">Riwayat peminjaman</span>
                    </a>
                </div>

                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Notifikasi</div>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="text-sm">Notifikasi</span>
                    </a>
                </div>

                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Aset</div>
                    
                    <div>
                        <button onclick="toggleKatalog()" type="button" class="w-full flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition text-left">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span class="text-sm flex-1">Katalog aset</span>
                            <svg id="katalog-arrow" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div id="katalog-submenu" class="hidden pl-12 space-y-1 mt-1">
                            <a href="{{ route('katalog.category', 'hp-smartphone') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">HP & Smartphone</a>
                            <a href="{{ route('katalog.category', 'laptop') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">Laptop</a>
                            <a href="{{ route('katalog.category', 'kamera') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">Kamera</a>
                            <a href="{{ route('katalog.category', 'playstation') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">PlayStation</a>
                        </div>
                    </div>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="text-sm">Aset saya</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="text-sm">Pengembalian aset</span>
                    </a>
                </div>

                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Lainnya</div>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-sm">Pengaturan</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <span class="text-sm">Bantuan</span>
                    </a>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name ?? 'User' }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email ?? 'user@nexus.com' }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white transition p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>
        <!-- ================= END SIDEBAR ================= -->

        <!-- ================= MAIN CONTENT ================= -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- HEADER (Search Bar) -->
            <header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
                <div class="flex-1 bg-nexus-green rounded-full px-6 py-3 flex items-center gap-3 border border-white/20">
                    <span class="text-white text-sm font-medium flex-1">Cari, aset, kategori, dan merek.........</span>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </header>

            <!-- CONTENT AREA -->
            <div class="flex-1 overflow-y-auto p-6 space-y-6">
                
                <!-- HERO BANNER -->
                <div class="gradient-hero rounded-3xl p-8 flex items-center justify-between text-white shadow-xl">
                    <div class="max-w-xl">
                        <h1 class="text-3xl font-bold mb-2 leading-tight">Sistem Peminjaman Aset<br><span class="text-4xl">Nexus Inventory</span></h1>
                        <p class="text-gray-300 text-sm mt-4 leading-relaxed">Pinjam aset yang anda butuhkan untuk mendukung pekerjaan dan kegiatan anda</p>
                    </div>
                    <div class="hidden md:flex items-end gap-3">
                        <img src="{{ asset('foto/image-removebg-preview.png') }}" class="w-32 drop-shadow-2xl transform -rotate-12">
                        <img src="{{ asset('foto/camera.png') }}" class="w-32 drop-shadow-2xl">
                        <img src="{{ asset('foto/hp.png') }}" class="w-28 drop-shadow-2xl transform rotate-6">
                        <img src="{{ asset('foto/playstation.png') }}" class="w-28 drop-shadow-2xl transform rotate-12">
                    </div>
                </div>

                <!-- CATEGORY CARDS (4 Horizontal) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $categories = [
                            ['name' => 'HP & Smartphone', 'slug' => 'hp-smartphone', 'desc' => 'Berbagai pilihan Hp terbaru dan berkualitas', 'assets' => 'foto/hp.png'],
                            ['name' => 'Laptop', 'slug' => 'laptop', 'desc' => 'Laptop untuk bekerja, belajar dan lain lain', 'assets' => 'foto/image-removebg-preview.png'],
                            ['name' => 'Kamera', 'slug' => 'kamera', 'desc' => 'Kamera yang berkualitas dan canggih', 'assets' => 'foto/camera.png'],
                            ['name' => 'Playstation', 'slug' => 'playstation', 'desc' => 'Konsol gaming untuk hiburan dan event', 'assets' => 'foto/playstation.png'],
                        ];
                    @endphp
                    
                    @foreach($categories as $cat)
                    <div class="bg-nexus-green rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                        <div class="relative z-10">
                            <h4 class="text-lg font-bold mb-3">{{ $cat['name'] }}</h4>
                            <p class="text-sm text-gray-200 leading-relaxed mb-4 max-w-[60%]">{{ $cat['desc'] }}</p>
                            <a href="{{ route('katalog.category', $cat['slug']) }}" 
                               class="inline-block bg-white text-nexus-green text-xs font-bold py-2 px-6 rounded-full hover:bg-gray-100 transition shadow-md">
                               LIHAT ASET
                            </a>
                        </div>
                        <img src="{{ asset($cat['assets']) }}" class="absolute -bottom-2 -right-2 w-32 h-32 object-contain drop-shadow-xl">
                    </div>
                    @endforeach
                </div>

                <!-- ASET TERSEDIA SECTION -->
                <div class="pb-6">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Aset Tersedia</h2>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Rekomendasi</h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                        @forelse($assets->take(5) as $item)
                        <div class="bg-nexus-green rounded-2xl p-5 text-white shadow-lg flex flex-col relative">
                            <!-- Badge Tersedia -->
                            <span class="absolute top-4 left-4 bg-white text-nexus-green text-xs font-bold px-3 py-1 rounded-lg">Tersedia</span>
                            
                            <!-- Container Gambar -->
                            <div class="h-40 flex items-center justify-center mb-4 mt-6">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" 
                                         alt="{{ $item->name }}" 
                                         class="max-h-full max-w-full object-contain drop-shadow-lg">
                                @else
                                    <div class="w-24 h-24 bg-white/10 rounded-xl flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Text Section -->
                            <div class="flex-1 flex flex-col text-center">
                                <h5 class="text-sm font-bold mb-2 leading-tight px-2">{{ Str::limit($item->name, 30) }}</h5>
                                <p class="text-xs text-gray-200 mb-1">stock tersedia {{ $item->stock }} unit</p>
                                <p class="text-xs text-gray-300 mb-4">minimal pinjam 1 hari</p>
                                
                                <a href="{{ route('user.borrowing.create', $item->id) }}" 
                                   class="mt-auto w-full bg-white text-nexus-green text-xs font-bold py-2.5 px-4 rounded-lg hover:bg-gray-100 transition text-center block shadow-md">
                                    Ajukan peminjaman
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-20 h-20 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="text-xl font-semibold text-gray-500 mb-2">Belum Ada Aset Tersedia</p>
                                <p class="text-sm text-gray-400">Aset akan muncul di sini setelah admin menambahkannya</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- FOOTER (Pagination) -->
            <footer class="bg-nexus-green text-white px-6 py-4 flex items-center justify-between flex-shrink-0">
                <span class="text-gray-200 text-sm">menampilkan 1-4</span>
                <div class="flex items-center gap-2">
                    <button class="p-2 hover:bg-white/20 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="px-4 py-2 bg-white text-nexus-green rounded-lg text-xs font-bold">1</button>
                    <button class="px-4 py-2 hover:bg-white/20 rounded-lg text-xs transition">2</button>
                    <button class="px-4 py-2 hover:bg-white/20 rounded-lg text-xs transition">3</button>
                    <button class="px-4 py-2 hover:bg-white/20 rounded-lg text-xs transition">4</button>
                    <button class="p-2 hover:bg-white/20 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </footer>

        </main>
    </div>

    <!-- JAVASCRIPT UNTUK HAMBURGER MENU -->
    <script>
        function toggleKatalog() {
            const submenu = document.getElementById('katalog-submenu');
            const arrow = document.getElementById('katalog-arrow');
            
            if (submenu && arrow) {
                submenu.classList.toggle('hidden');
                
                if (submenu.classList.contains('hidden')) {
                    arrow.style.transform = 'rotate(0deg)';
                } else {
                    arrow.style.transform = 'rotate(180deg)';
                }
            }
        }
    </script>

</body>
</html>