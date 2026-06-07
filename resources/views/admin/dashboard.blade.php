<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Nexus Inventory</title>
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
                <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Utama</div>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-lg text-white font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.assets.index') }}" 
   class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
    <span class="text-sm">Kelola Aset</span>
</a>
                
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span class="text-sm">Peminjaman</span>
                </a>
                
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="text-sm">Pengguna</span>
                </a>

                <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4">Lainnya</div>
                
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span class="text-sm">Laporan</span>
                </a>
                
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-sm">Pengaturan</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Admin Nexus</p>
                        <p class="text-xs text-gray-400">admin@nexus.com</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- ================= MAIN CONTENT ================= -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- HEADER -->
            <header class="bg-gray-300 p-4 flex items-center justify-between flex-shrink-0">
                <h1 class="text-xl font-bold text-gray-800">Dashboard Admin</h1>
                <div class="flex items-center gap-4">
                    <div class="bg-nexus-green rounded-full px-4 py-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="text-white text-sm">12 Notifikasi</span>
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <div class="flex-1 overflow-y-auto p-6 space-y-6">
                
                <!-- STATS CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-nexus-green">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Total Aset</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_assets'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-nexus-accent rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Tersedia</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['available_assets'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Dipinjam</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['borrowed_assets'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Total User</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TWO COLUMNS -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- RECENT BOOKINGS (2/3 width) -->
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="bg-nexus-green px-6 py-4 flex items-center justify-between">
                            <h3 class="text-white font-bold text-lg">Peminjaman Terbaru</h3>
                            <a href="#" class="text-white text-sm hover:underline">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Peminjam</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aset</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($recentBookings as $booking)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $booking['id'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking['user'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking['asset'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $booking['date'] }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                @if($booking['status'] === 'Pending') bg-yellow-100 text-yellow-800
                                                @elseif($booking['status'] === 'Approved') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ $booking['status'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($booking['status'] === 'Pending')
                                                <div class="flex gap-2">
                                                    <button class="text-green-600 hover:text-green-800 text-sm font-semibold">Approve</button>
                                                    <button class="text-red-600 hover:text-red-800 text-sm font-semibold">Reject</button>
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-400">
                                                <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                                <p class="text-lg font-medium text-gray-500">Belum Ada Peminjaman</p>
                                                <p class="text-sm text-gray-400 mt-1">Data peminjaman akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- RIGHT SIDEBAR (1/3 width) -->
                    <div class="space-y-6">
                     <!-- QUICK ACTIONS -->
<div class="bg-white rounded-xl shadow-md p-6">
    <h3 class="font-bold text-lg mb-4 text-gray-800">Aksi Cepat</h3>
    <div class="space-y-3">
        <!-- Tombol Tambah Aset Baru (SUDAH BERFUNGSI) -->
        <a href="{{ route('admin.assets.create') }}" 
           class="w-full bg-nexus-green text-white py-3 px-4 rounded-lg hover:bg-nexus-light transition font-semibold flex items-center justify-center gap-2 shadow-sm no-underline">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Aset Baru
        </a>
        
        <!-- Tombol Lihat Laporan -->
        <a href="{{ route('admin.reports') }}" 
           class="w-full bg-white border-2 border-nexus-green text-nexus-green py-3 px-4 rounded-lg hover:bg-nexus-accent transition font-semibold flex items-center justify-center gap-2 no-underline">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Lihat Laporan
        </a>
        
        <!-- Tombol Kelola User -->
        <a href="{{ route('admin.users') }}" 
           class="w-full bg-white border-2 border-nexus-green text-nexus-green py-3 px-4 rounded-lg hover:bg-nexus-accent transition font-semibold flex items-center justify-center gap-2 no-underline">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            Kelola User
        </a>
    </div>
</div>  

                        <!-- PENDING APPROVALS -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h4 class="font-semibold text-gray-700 mb-3">Menunggu Persetujuan</h4>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-sm text-yellow-800 font-semibold mb-1">{{ $stats['pending_bookings'] }} Peminjaman</p>
                                <p class="text-xs text-yellow-600">Perlu verifikasi segera</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

</body>
</html>