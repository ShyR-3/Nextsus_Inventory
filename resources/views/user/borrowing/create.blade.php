@extends('layouts.user')

@section('title', 'Ajukan Peminjaman')

@section('content')
<!-- HEADER -->
<header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
    <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-200 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1 class="text-white font-bold text-lg">Ajukan Peminjaman</h1>
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
                            <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
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
                <h3 class="font-bold text-lg mb-4">Form Pengajuan Peminjaman</h3>
                
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
                            @error('borrow_date')
                                <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm text-gray-200 mb-2">Tanggal kembali</label>
                            <input type="date" name="return_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-white/50">
                            @error('return_date')
                                <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-200 mb-2">Keperluan peminjaman</label>
                        <input type="text" name="notes" required placeholder="Contoh: Presentasi project"
                               class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/50">
                        @error('notes')
                            <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-200 mb-2">Lokasi Penggunaan</label>
                        <input type="text" name="location" required placeholder="Contoh: Kantor Pusat PT Media"
                               class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/50">
                        @error('location')
                            <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <a href="{{ route('katalog') }}" class="flex-1 bg-black text-white py-3 rounded-lg font-semibold text-center hover:bg-gray-800 transition">
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
                <h3 class="font-bold text-lg mb-4 text-center">Ringkasan Pengajuan</h3>
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
            <svg class="w-4 h-4 text-nexus-green" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-sm">Setelah diajukan, permintaan Anda akan dikonfirmasi oleh admin</p>
    </div>

</div>
@endsection