<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - Nexus Inventory</title>
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
                
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-sm">Beranda</span>
                </a>
                
                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">peminjaman</div>
                    <a href="{{ route('katalog') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span class="text-sm">Ajukan peminjaman</span>
                    </a>
                    <a href="{{ route('user.borrowing.history') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-lg transition mt-1">
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
                    <a href="{{ route('katalog') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        <span class="text-sm">Katalog aset</span>
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
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
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

        <!-- ================= MAIN CONTENT ================= -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- HEADER -->
            <header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
                <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-white font-bold text-lg">Riwayat Peminjaman</h1>
            </header>

            <!-- CONTENT AREA -->
            <div class="flex-1 overflow-y-auto p-6">
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-yellow-500">
                        <p class="text-sm text-gray-600">Menunggu Persetujuan</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $borrowings->where('status', 'pending')->count() }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-blue-500">
                        <p class="text-sm text-gray-600">Disetujui</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $borrowings->where('status', 'approved')->count() }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-orange-500">
                        <p class="text-sm text-gray-600">Sedang Dipinjam</p>
                        <p class="text-2xl font-bold text-orange-600">{{ $borrowings->where('status', 'borrowed')->count() }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-green-500">
                        <p class="text-sm text-gray-600">Dikembalikan</p>
                        <p class="text-2xl font-bold text-green-600">{{ $borrowings->where('status', 'returned')->count() }}</p>
                    </div>
                </div>

                <!-- Tabel Riwayat -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800">Daftar Peminjaman Anda</h3>
                        <p class="text-sm text-gray-600 mt-1">Pantau status peminjaman aset Anda</p>
                    </div>

                    @if($borrowings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aset</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pinjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Kembali</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keperluan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($borrowings as $borrowing)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $borrowing->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="font-semibold">{{ $borrowing->asset->name ?? 'Aset tidak ditemukan' }}</div>
                                        <div class="text-xs text-gray-500">{{ $borrowing->asset->category ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $borrowing->borrow_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $borrowing->return_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                        {{ $borrowing->notes }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'approved' => 'bg-blue-100 text-blue-800',
                                                'borrowed' => 'bg-orange-100 text-orange-800',
                                                'returned' => 'bg-green-100 text-green-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusLabels = [
                                                'pending' => 'Menunggu Persetujuan',
                                                'approved' => 'Disetujui',
                                                'borrowed' => 'Sedang Dipinjam',
                                                'returned' => 'Dikembalikan',
                                                'rejected' => 'Ditolak',
                                            ];
                                        @endphp
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$borrowing->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusLabels[$borrowing->status] ?? $borrowing->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($borrowings->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $borrowings->links() }}
                    </div>
                    @endif

                    @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Riwayat Peminjaman</h3>
                        <p class="text-gray-500 mb-6">Anda belum pernah mengajukan peminjaman aset</p>
                        <a href="{{ route('katalog') }}" class="inline-block bg-nexus-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                            Ajukan Peminjaman Sekarang
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Info Note -->
                <div class="mt-6 bg-nexus-green rounded-xl p-4 flex items-center gap-3 text-white">
                    <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-nexus-green" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    </div>
                    <p class="text-sm">Status peminjaman akan diperbarui secara real-time oleh admin</p>
                </div>

            </div>

        </main>
    </div>

</body>
</html>