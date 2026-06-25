<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Peminjaman - Nexus Inventory</title>
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
    </style>
</head>
<body class="bg-gray-200 text-gray-800 h-screen overflow-hidden">

    <div class="flex h-screen">
        
        <!-- SIDEBAR -->
        <aside class="w-64 bg-gradient-to-b from-nexus-dark to-black text-white flex flex-col flex-shrink-0">
            <div class="p-6 flex items-center justify-center border-b border-white/10">
                <img src="{{ asset('foto/logo.png') }}" alt="Nexus Inventory" class="h-16 w-auto">
            </div>

            <nav class="px-3 py-4 space-y-1 flex-1 overflow-y-auto">
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-sm">Beranda</span>
                </a>
                
                <div class="mt-4">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">peminjaman</div>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span class="text-sm">Ajukan peminjaman</span>
                    </a>
                    <a href="{{ route('user.borrowing.history') }}" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-white/10 hover:text-white rounded-lg transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm">Riwayat peminjaman</span>
                    </a>
                </div>
            </nav>

            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- HEADER -->
            <header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
                <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-white font-bold text-lg">Ajukan peminjaman</h1>
            </header>

            <!-- CONTENT -->
            <div class="flex-1 overflow-y-auto p-6">
                
                <!-- STEPPER -->
                <div class="mb-8">
                    <div class="flex items-center justify-between max-w-2xl">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-nexus-green text-white flex items-center justify-center font-bold text-sm">✓</div>
                            <span class="text-xs mt-2 text-gray-600">Pilih aset</span>
                        </div>
                        <div class="flex-1 h-1 bg-nexus-green mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-nexus-green text-white flex items-center justify-center font-bold text-sm ring-4 ring-nexus-green/30">2</div>
                            <span class="text-xs mt-2 font-semibold text-nexus-green">Isi Data</span>
                        </div>
                        <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm">3</div>
                            <span class="text-xs mt-2 text-gray-400">Konfirmasi</span>
                        </div>
                        <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm">4</div>
                            <span class="text-xs mt-2 text-gray-400">Menunggu Persetujuan</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- LEFT COLUMN (2/3) -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- DETAIL ASET -->
                        <div class="bg-nexus-green rounded-2xl p-6 text-white shadow-xl">
                            <h3 class="font-bold text-lg mb-4">Detail Aset</h3>
                            <div class="flex gap-6">
                                <div class="w-32 h-32 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    @if($asset->image)
                                        <img src="{{ asset('storage/' . $asset->image) }}" alt="{{ $asset->name }}" class="max-h-full max-w-full object-contain">
                                    @else
                                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-xl mb-1">{{ $asset->name }}</h4>
                                    <p class="text-sm text-gray-200 mb-3">{{ $asset->specification }}</p>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-300 w-20">Status</span>
                                            <span class="bg-white text-nexus-green text-xs font-bold px-3 py-1 rounded-lg">Tersedia</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-300 w-20">Stock</span>
                                            <span class="bg-white/20 px-3 py-1 rounded-lg">{{ $asset->stock }} unit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FORM PENGAJUAN -->
                        <div class="bg-nexus-green rounded-2xl p-6 text-white shadow-xl">
                            <h3 class="font-bold text-lg mb-4">Form Pengajuan peminjaman</h3>
                            
                            @if(session('error'))
                                <div class="bg-red-500/20 border border-red-500 text-white px-4 py-3 rounded-lg mb-4">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('user.borrowing.confirm', $asset) }}" method="POST" class="space-y-4">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-200 mb-2">Tanggal pinjam</label>
                                        <input type="date" name="borrow_date" required min="{{ date('Y-m-d') }}"
                                               class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-white/50">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-200 mb-2">Tanggal kembali</label>
                                        <input type="date" name="return_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-white/50">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm text-gray-200 mb-2">Keperluan peminjaman</label>
                                    <input type="text" name="notes" required placeholder="Contoh: Presentasi project"
                                           class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/50">
                                </div>

                                <div>
                                    <label class="block text-sm text-gray-200 mb-2">Lokasi Penggunaan</label>
                                    <input type="text" name="location" required placeholder="Contoh: kantor Pusat PT Media"
                                           class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/50">
                                </div>

                                <div class="flex gap-3 pt-4">
                                    <a href="{{ route('user.dashboard') }}" class="flex-1 bg-black text-white py-3 rounded-lg font-semibold text-center hover:bg-gray-800 transition">
                                        Batal
                                    </a>
                                    <button type="submit" class="flex-1 bg-white text-nexus-green py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                                        Lanjut ke Konfirmasi
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                    <!-- RIGHT COLUMN (1/3) - RINGKASAN -->
                    <div class="lg:col-span-1">
                        <div class="bg-nexus-green rounded-2xl p-6 text-white shadow-xl sticky top-6">
                            <h3 class="font-bold text-lg mb-4 text-center">Ringkasan pengajuan</h3>
                            <div class="space-y-4 text-sm">
                                <div class="flex justify-between border-b border-white/10 pb-3">
                                    <span class="text-gray-300">Peminjam</span>
                                    <span class="font-semibold">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="flex justify-between border-b border-white/10 pb-3">
                                    <span class="text-gray-300">Aset</span>
                                    <span class="font-semibold text-right">{{ $asset->name }}</span>
                                </div>
                                <div class="flex justify-between border-b border-white/10 pb-3">
                                    <span class="text-gray-300">Stock</span>
                                    <span class="font-semibold">{{ $asset->stock }} unit</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Status</span>
                                    <span class="bg-white text-nexus-green text-xs font-bold px-3 py-1 rounded-lg">Tersedia</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- INFO NOTE -->
                <div class="mt-6 bg-nexus-green rounded-xl p-4 flex items-center gap-3 text-white">
                    <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-nexus-green" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    </div>
                    <p class="text-sm">Setelah diajukan, permintaan anda akan dikonfirmasi oleh admin</p>
                </div>

            </div>

            <!-- FOOTER -->
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

</body>
</html>