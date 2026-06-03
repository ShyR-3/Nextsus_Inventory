<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog {{ $categoryName }} - Nexus Inventory</title>
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
    </style>
</head>
<body class="bg-gray-200 text-gray-800 h-screen overflow-hidden">

    <div class="flex h-screen">
        
        <!-- SIDEBAR -->
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
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Beranda
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <span class="text-sm">peminjaman</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <span class="text-sm">Ajukan peminjaman</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <span class="text-sm">Riwayat peminjaman</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <span class="text-sm">Notifikasi</span>
                </a>

                <div class="px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Aset</div>
                
                <!-- ✅ KATALOG ASET DENGAN DROPDOWN (BARU) -->
                <div>
                    <button id="katalog-toggle" class="w-full flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-lg transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="text-sm flex-1 text-left">Katalog aset</span>
                        <!-- Panah dropdown (selalu terbuka di halaman katalog) -->
                        <svg id="katalog-arrow" class="w-4 h-4 transition-transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Submenu Katalog (SELALU TERBUKA di halaman katalog) -->
                    <div id="katalog-submenu" class="pl-12 space-y-1 mt-1">
                        <a href="{{ route('katalog.category', 'hp-smartphone') }}" class="block px-4 py-2 text-sm {{ request()->is('katalog/hp-smartphone') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition">
                            HP & Smartphone
                        </a>
                        <a href="{{ route('katalog.category', 'laptop') }}" class="block px-4 py-2 text-sm {{ request()->is('katalog/laptop') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition">
                            Laptop
                        </a>
                        <a href="{{ route('katalog.category', 'kamera') }}" class="block px-4 py-2 text-sm {{ request()->is('katalog/kamera') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition">
                            Kamera
                        </a>
                        <a href="{{ route('katalog.category', 'playstation') }}" class="block px-4 py-2 text-sm {{ request()->is('katalog/playstation') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition">
                            PlayStation
                        </a>
                    </div>
                </div>
                <!-- ✅ AKHIR DROPDOWN KATALOG -->

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <span class="text-sm">Aset saya</span>
                </a>

                <div class="px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Lainnya</div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <span class="text-sm">Pengaturan</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <span class="text-sm">Bantuan</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT (TIDAK DIUBAH - FOTO TETAP SAMA) -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- HEADER -->
            <header class="bg-gray-300 p-3 flex items-center gap-4 flex-shrink-0">
                <a href="{{ route('user.dashboard') }}" class="text-nexus-green hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div class="flex-1 bg-nexus-green rounded-full px-5 py-3 flex items-center gap-3">
                    <span class="text-white text-sm font-medium flex-1">Cari, aset, kategori, dan merek........</span>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </header>

            <!-- CONTENT -->
            <div class="flex-1 overflow-y-auto p-6">
                
                <!-- Header Katalog -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Katalog {{ $categoryName }}</h2>
                    <p class="text-gray-600 text-sm">Pilih aset yang ingin Anda pinjam</p>
                </div>

                <!-- Grid Aset (KODE FOTO TETAP SAMA PERSIS) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @forelse($assets as $item)
                    <div class="bg-nexus-main rounded-2xl p-4 text-white flex flex-col items-center text-center shadow-lg hover:shadow-xl transition">
                        <span class="bg-white text-nexus-green text-xs font-bold px-3 py-1 rounded-lg self-start mb-3">Tersedia</span>
                        <img src="{{ asset($item['image'] ?? 'foto/laptop-1.png') }}" class="w-full h-40 object-contain mb-3 drop-shadow-lg" alt="{{ $item['name'] }}">
                        <h3 class="text-sm font-semibold mb-2 leading-tight">{{ $item['name'] }}</h3>
                        <p class="text-xs text-gray-200 mb-1">Stock: {{ $item['stock'] }} unit</p>
                        <p class="text-xs text-gray-300 mb-4">Minimal pinjam 1 hari</p>
                        <button class="w-full bg-nexus-accent text-nexus-dark text-xs font-bold py-2 px-4 rounded-lg hover:bg-white transition">
                            Ajukan peminjaman
                        </button>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Belum ada aset tersedia di kategori ini</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($assets->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $assets->links() }}
                </div>
                @endif

            </div>

        </main>
    </div>

    <!-- ✅ JavaScript untuk Toggle Submenu (TAMBAHAN BARU) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const katalogToggle = document.getElementById('katalog-toggle');
            const katalogSubmenu = document.getElementById('katalog-submenu');
            const katalogArrow = document.getElementById('katalog-arrow');
            
            if (katalogToggle) {
                katalogToggle.addEventListener('click', function() {
                    if (katalogSubmenu.classList.contains('hidden')) {
                        katalogSubmenu.classList.remove('hidden');
                        katalogArrow.style.transform = 'rotate(180deg)';
                    } else {
                        katalogSubmenu.classList.add('hidden');
                        katalogArrow.style.transform = 'rotate(0deg)';
                    }
                });
            }
        });
    </script>

</body>
</html>