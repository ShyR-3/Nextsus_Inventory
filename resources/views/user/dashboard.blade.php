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
                            dark: '#0D3310',
                            main: '#1B5E20',
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
        /* Hilangkan scrollbar bawaan browser */
        ::-webkit-scrollbar { display: none; }
        body { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<!-- TAMBAHAN: h-screen & overflow-hidden mengunci layar penuh -->
<body class="bg-gray-100 text-gray-800 h-screen overflow-hidden">

    <div class="flex h-screen">
        
        <!-- SIDEBAR (Fixed) -->
        <aside class="w-64 bg-nexus-dark text-white flex flex-col flex-shrink-0">
            <div class="p-6 flex items-center gap-3">
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

            <nav class="px-4 space-y-1 mt-2 flex-1 overflow-y-auto">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-nexus-main rounded-lg text-white font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Beranda
                </a>
                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">peminjaman</div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-nexus-main hover:text-white rounded-lg transition">
                    <span class="text-xl font-light">+</span>
                    <span class="text-sm">Ajukan peminjaman</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-nexus-main hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    <span class="text-sm">Riwayat peminjaman</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-nexus-main hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="text-sm">Notifikasi</span>
                </a>

                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">ASET</div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-nexus-main hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <span class="text-sm">Katalog aset</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-nexus-main hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span class="text-sm">Aset saya</span>
                </a>
            </nav>

            <div class="px-4 pb-6">
                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Lainnya</div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-nexus-main hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-sm">Pengaturan</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-nexus-main hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm">Bantuan</span>
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT (Fixed Height, No Scroll) -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- Top Search Bar (Fixed) -->
            <header class="bg-nexus-main p-4 flex items-center gap-4 flex-shrink-0">
                <div class="flex-1 bg-nexus-dark rounded-full px-5 py-2.5 flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Cari, aset, kategori, dan merek......." class="bg-transparent text-white placeholder-gray-400 focus:outline-none w-full text-sm">
                </div>
            </header>

            <!-- Content Area (Locked Height) -->
            <div class="flex-1 overflow-hidden p-6 space-y-6">
                
                <!-- Hero Banner -->
                <div class="bg-nexus-dark rounded-2xl p-6 flex items-center justify-between text-white shadow-lg flex-shrink-0">
                    <div>
                        <h2 class="text-2xl font-bold mb-1">Sistem Peminjaman Aset</h2>
                        <p class="text-xl font-semibold text-gray-300">Nexus Inventory</p>
                    </div>
                    <div class="hidden md:flex items-end gap-3">
                        <img src="{{ asset('foto/image-removebg-preview.png') }}" class="w-24 drop-shadow-lg transform -rotate-6">
                        <img src="{{ asset('foto/camera.png') }}" class="w-28 drop-shadow-lg">
                        <img src="{{ asset('foto/phone.png') }}" class="w-20 drop-shadow-lg transform rotate-6">
                        <img src="{{ asset('foto/playstation.png') }}" class="w-24 drop-shadow-lg transform rotate-12">
                    </div>
                </div>

                <!-- Grid Aset (Auto-fit, No Scroll) -->
                <div>
                    <h3 class="text-xl font-bold text-nexus-dark mb-4">Aset Tersedia</h3>
                    
                    <!-- Laptop -->
<div class="mb-4">
    <h4 class="text-lg font-semibold text-gray-700 mb-2">Laptop</h4>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-3">
        @php
            $laptops = [
                ['name' => 'HP Pavilion 14', 'stock' => 20],
                ['name' => 'ASUS ROG Strix', 'stock' => 15],
                ['name' => 'ROG Flow X13', 'stock' => 17],
                ['name' => 'Acer Swift 3', 'stock' => 21],
                ['name' => 'ASUS VIVOBOOK 14', 'stock' => 25],
            ];
        @endphp
        @foreach($laptops as $item)
        <div class="bg-nexus-main rounded-xl p-2 text-white flex flex-col items-center text-center shadow-md">
            <span class="bg-white text-nexus-main text-[10px] font-bold px-2 py-0.5 rounded self-start mb-1">Tersedia</span>
            <img src="https://via.placeholder.com/120x90/1B5E20/FFFFFF?text=Laptop" class="w-full h-20 object-contain mb-1 drop-shadow">
            <!-- NAMA ASET -->
            <p class="text-[10px] font-semibold text-white mb-1">{{ $item['name'] }}</p>
            <p class="text-[10px] text-gray-200 leading-tight">stock {{ $item['stock'] }} unit<br>min. 1 hari</p>
            <button class="mt-1 bg-nexus-accent text-nexus-dark text-[10px] font-bold py-1 px-2 rounded hover:bg-white transition w-full">Ajukan peminjaman</button>
        </div>
        @endforeach
                        </div>
                    </div>

                    <!-- Camera -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-700 mb-2">Camera</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                            @php
                                $cameras = [
                                    ['name' => 'Sony Alpha a6000', 'stock' => 20],
                                    ['name' => 'Canon EOS M50', 'stock' => 23],
                                    ['name' => 'Sony FE 24-70mm', 'stock' => 17],
                                    ['name' => 'Sony Alpha a7 III', 'stock' => 26],
                                    ['name' => 'Mini Digital Camera', 'stock' => 12],
                                ];
                            @endphp
                            @foreach($cameras as $item)
                            <div class="bg-nexus-main rounded-xl p-2 text-white flex flex-col items-center text-center shadow-md">
                                <span class="bg-white text-nexus-main text-[10px] font-bold px-2 py-0.5 rounded self-start mb-1">Tersedia</span>
                                <img src="https://via.placeholder.com/120x90/1B5E20/FFFFFF?text=Camera" class="w-full h-20 object-contain mb-1 drop-shadow">
                                <p class="text-[10px] text-gray-200 leading-tight">stock {{ $item['stock'] }} unit<br>min. 1 hari</p>
                                <button class="mt-1 bg-nexus-accent text-nexus-dark text-[10px] font-bold py-1 px-2 rounded hover:bg-white transition w-full">Ajukan</button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination Footer (Fixed) -->
            <footer class="bg-nexus-dark text-white px-6 py-2 flex items-center justify-between text-xs flex-shrink-0">
                <span class="text-gray-400">menampilkan 1-4</span>
                <div class="flex items-center gap-1">
                    <button class="px-2 hover:bg-nexus-main rounded">◀</button>
                    <button class="w-6 h-6 bg-nexus-main rounded text-[10px] font-bold">1</button>
                    <button class="w-6 h-6 hover:bg-nexus-main rounded text-[10px]">2</button>
                    <button class="w-6 h-6 hover:bg-nexus-main rounded text-[10px]">3</button>
                    <button class="w-6 h-6 hover:bg-nexus-main rounded text-[10px]">4</button>
                    <button class="px-2 hover:bg-nexus-main rounded">▶</button>
                </div>
            </footer>

        </main>
    </div>

</body>
</html>