@extends('layouts.user')

@section('title', 'Konfirmasi Peminjaman')

@section('content')
<!-- HEADER -->
<header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
    <a href="{{ route('user.borrowing.create', $asset) }}" class="text-white hover:text-gray-200 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1 class="text-white font-bold text-lg">Konfirmasi Peminjaman</h1>
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
                <div class="w-8 h-8 rounded-full bg-nexus-green text-white flex items-center justify-center font-bold text-sm">✓</div>
                <span class="text-xs mt-2 text-gray-600">Isi Data</span>
            </div>
            <div class="flex-1 h-1 bg-nexus-green mx-2"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-nexus-green text-white flex items-center justify-center font-bold text-sm ring-4 ring-nexus-green/30">3</div>
                <span class="text-xs mt-2 font-semibold text-nexus-green">Konfirmasi</span>
            </div>
            <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm">4</div>
                <span class="text-xs mt-2 text-gray-400">Menunggu Persetujuan</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- LEFT -->
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

            <!-- DATA PENGAJUAN -->
            <div class="bg-nexus-green rounded-2xl p-6 text-white shadow-xl">
                <h3 class="font-bold text-lg mb-4">Data Pengajuan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between border-b border-white/10 pb-2">
                        <span class="text-gray-300">Tanggal Pinjam</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($validated['borrow_date'])->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-2">
                        <span class="text-gray-300">Tanggal Kembali</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($validated['return_date'])->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-2">
                        <span class="text-gray-300">Durasi</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($validated['borrow_date'])->diffInDays(\Carbon\Carbon::parse($validated['return_date'])) }} Hari</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-2">
                        <span class="text-gray-300">Keperluan</span>
                        <span class="font-semibold">{{ $validated['notes'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-300">Lokasi</span>
                        <span class="font-semibold">{{ $validated['location'] }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT - RINGKASAN -->
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
                        <span class="text-gray-300">Durasi</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($validated['borrow_date'])->diffInDays(\Carbon\Carbon::parse($validated['return_date'])) }} Hari</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-3">
                        <span class="text-gray-300">Tanggal</span>
                        <span class="font-semibold text-right text-xs">{{ \Carbon\Carbon::parse($validated['borrow_date'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($validated['return_date'])->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-300">Status</span>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-lg">Menunggu Persetujuan</span>
                    </div>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="flex gap-3 mt-6">
                    <a href="{{ route('user.borrowing.create', $asset) }}" class="flex-1 bg-black text-white py-3 rounded-lg font-semibold text-center hover:bg-gray-800 transition text-sm">
                        Batal
                    </a>
                    <form action="{{ route('user.borrowing.store', $asset) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-white text-nexus-green py-3 rounded-lg font-semibold hover:bg-gray-100 transition text-sm">
                            Ajukan Peminjaman
                        </button>
                    </form>
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