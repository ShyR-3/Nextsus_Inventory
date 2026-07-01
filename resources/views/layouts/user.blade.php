<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Nexus Inventory</title>
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
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        ::-webkit-scrollbar { display: none; }
        body { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-200 text-gray-800 h-screen overflow-hidden">

    <div class="flex h-screen">
        
        <!-- ================= SIDEBAR (KONSISTEN) ================= -->
        <aside class="w-64 bg-gradient-to-b from-nexus-dark to-black text-white flex flex-col flex-shrink-0">
            
            <!-- Logo -->
            <div class="p-6 flex items-center justify-center border-b border-white/10">
                <img src="{{ asset('foto/logo.png') }}" alt="Nexus Inventory" class="h-16 w-auto">
            </div>

            <!-- Navigation -->
            <nav class="px-3 py-4 space-y-1 flex-1 overflow-y-auto">
                
                <!-- Menu Utama -->
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Menu Utama</div>
                
                <a href="{{ route('user.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.dashboard') ? 'bg-white text-nexus-dark font-semibold rounded-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-sm">Beranda</span>
                </a>
                
                <!-- Peminjaman -->
                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Peminjaman</div>
                    
                    <a href="{{ route('katalog') }}" 
                       class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('katalog*') ? 'bg-white/10 text-white rounded-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-sm">Ajukan Peminjaman</span>
                    </a>
                    
                    <a href="{{ route('user.borrowing.history') }}" 
                       class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.borrowing.history') ? 'bg-white/10 text-white rounded-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition' }} mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">Riwayat Peminjaman</span>
                    </a>
                </div>

                <!-- Notifikasi -->
                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Notifikasi</div>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="text-sm">Notifikasi</span>
                    </a>
                </div>

                <!-- Aset -->
                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Aset</div>
                    
                    <!-- Katalog Aset dengan Dropdown -->
                    <div>
                        <button onclick="toggleKatalog()" type="button" 
                                class="w-full flex items-center gap-3 px-4 py-3 {{ request()->routeIs('katalog*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }} rounded-lg transition text-left">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span class="text-sm flex-1">Katalog Aset</span>
                            <svg id="katalog-arrow" class="w-4 h-4 transition-transform duration-300 {{ request()->routeIs('katalog*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div id="katalog-submenu" class="{{ request()->routeIs('katalog*') ? '' : 'hidden' }} pl-12 space-y-1 mt-1">
                            <a href="{{ route('katalog.category', 'hp-smartphone') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('katalog.category') && request()->route('katalog.category') == 'hp-smartphone' ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition">HP & Smartphone</a>
                            <a href="{{ route('katalog.category', 'laptop') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('katalog.category') && request()->route('katalog.category') == 'laptop' ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition">Laptop</a>
                            <a href="{{ route('katalog.category', 'kamera') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('katalog.category') && request()->route('katalog.category') == 'kamera' ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition">Kamera</a>
                            <a href="{{ route('katalog.category', 'playstation') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('katalog.category') && request()->route('katalog.category') == 'playstation' ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition">PlayStation</a>
                        </div>
                    </div>

                    <!-- Aset Saya -->
                    <a href="{{ route('user.assets') }}" 
                       class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.assets') ? 'bg-white/10 text-white rounded-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition' }} mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-sm">Aset Saya</span>
                    </a>
                    
                    <!-- ✅ PENGEMBALIAN ASET - LINK YANG BENAR (DI DALAM NAV, BUKAN DI SCRIPT) -->
                    <a href="{{ route('user.returns') }}" 
                       class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.returns') ? 'bg-white/10 text-white rounded-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition' }} mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-sm">Pengembalian Aset</span>
                    </a>
                </div>
                <!-- ✅ UPDATED: Pengaturan (sekarang bisa diklik!) -->
<a href="{{ route('user.settings') }}" 
   class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.settings*') ? 'bg-white/10 text-white rounded-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
    </svg>
    <span class="text-sm">Pengaturan</span>
</a>

                <!-- Lainnya -->
                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Lainnya</div>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm">Pengaturan</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-sm">Bantuan</span>
                    </a>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white transition p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- ================= MAIN CONTENT ================= -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript untuk Toggle Katalog -->
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

    @stack('scripts')
</body>
</html>