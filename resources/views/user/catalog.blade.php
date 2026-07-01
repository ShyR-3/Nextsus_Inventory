@extends('layouts.user')

@section('title', 'Katalog ' . ($categoryNameLabel ?? 'Aset'))

@section('content')
<!-- HEADER (Search Bar) -->
<header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
    <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-200 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <div class="flex-1 bg-nexus-green rounded-full px-6 py-3 flex items-center gap-3 border border-white/20">
        <span class="text-white text-sm font-medium flex-1">Cari, aset, kategori, dan merek.........</span>
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
</header>

<!-- CONTENT AREA -->
<div class="flex-1 overflow-y-auto p-6">
    
    <!-- Header Katalog -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Katalog {{ $categoryNameLabel ?? 'Aset' }}</h2>
        <p class="text-gray-600 text-sm">Pilih aset yang ingin Anda pinjam</p>
    </div>

    <!-- Grid Aset -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($assets as $item)
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
                <h3 class="text-sm font-bold mb-2 leading-tight px-2">{{ Str::limit($item->name, 35) }}</h3>
                <p class="text-xs text-gray-200 mb-1">Stock: {{ $item->stock }} unit</p>
                <p class="text-xs text-gray-300 mb-4">Minimal pinjam 1 hari</p>
                
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

    <!-- Pagination -->
    @if($assets->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $assets->links() }}
    </div>
    @endif

</div>
@endsection