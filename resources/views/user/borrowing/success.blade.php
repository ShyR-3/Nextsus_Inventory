@extends('layouts.user')

@section('title', 'Peminjaman Diajukan')

@section('content')
<!-- HEADER -->
<header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
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
                <div class="w-8 h-8 rounded-full bg-nexus-green text-white flex items-center justify-center font-bold text-sm">✓</div>
                <span class="text-xs mt-2 text-gray-600">Isi Data</span>
            </div>
            <div class="flex-1 h-1 bg-nexus-green mx-2"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-nexus-green text-white flex items-center justify-center font-bold text-sm">✓</div>
                <span class="text-xs mt-2 text-gray-600">Konfirmasi</span>
            </div>
            <div class="flex-1 h-1 bg-nexus-green mx-2"></div>
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full bg-nexus-green text-white flex items-center justify-center font-bold text-sm ring-4 ring-nexus-green/30">✓</div>
                <span class="text-xs mt-2 font-semibold text-nexus-green">Menunggu Persetujuan</span>
            </div>
        </div>
    </div>

    <!-- SUCCESS CARD -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-nexus-green rounded-2xl p-8 text-white shadow-xl text-center">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold mb-2">Peminjaman Berhasil Diajukan!</h2>
            <p class="text-gray-200 mb-6">Permintaan peminjaman Anda sedang menunggu persetujuan admin</p>
            
            <div class="bg-white/10 rounded-xl p-4 mb-6 text-left">
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-300">Aset</span>
                        <span class="font-semibold">{{ $asset->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-300">Tanggal Pinjam</span>
                        <span class="font-semibold">{{ $borrowing->borrow_date->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-300">Tanggal Kembali</span>
                        <span class="font-semibold">{{ $borrowing->return_date->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-300">Status</span>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-lg">Menunggu Persetujuan</span>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('user.dashboard') }}" class="flex-1 bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('user.borrowing.history') }}" class="flex-1 bg-white text-nexus-green py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Lihat Riwayat
                </a>
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

</div>
@endsection