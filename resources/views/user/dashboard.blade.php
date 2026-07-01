@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<!-- HEADER (Search Bar) -->
<header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
    <div class="flex-1 bg-nexus-green rounded-full px-6 py-3 flex items-center gap-3 border border-white/20">
        <span class="text-white text-sm font-medium flex-1">Cari, aset, kategori, dan merek.........</span>
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
</header>

<!-- CONTENT AREA -->
<div class="flex-1 overflow-y-auto p-6 space-y-6">
    
    <!-- HERO BANNER -->
    <div class="rounded-3xl p-8 flex items-center justify-between text-white shadow-xl" style="background: linear-gradient(135deg, #0D1F0D 0%, #1B3A1B 100%);">
        <div class="max-w-xl">
            <h1 class="text-3xl font-bold mb-2 leading-tight">Sistem Peminjaman Aset<br><span class="text-4xl">Nexus Inventory</span></h1>
            <p class="text-gray-300 text-sm mt-4 leading-relaxed">Pinjam aset yang anda butuhkan untuk mendukung pekerjaan dan kegiatan anda</p>
        </div>
        <div class="hidden md:flex items-end gap-3">
            <img src="{{ asset('foto/image-removebg-preview.png') }}" class="w-32 drop-shadow-2xl transform -rotate-12">
            <img src="{{ asset('foto/camera.png') }}" class="w-32 drop-shadow-2xl">
            <img src="{{ asset('foto/hp.png') }}" class="w-28 drop-shadow-2xl transform rotate-6">
            <img src="{{ asset('foto/playstation.png') }}" class="w-28 drop-shadow-2xl transform rotate-12">
        </div>
    </div>

    <!-- CATEGORY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $categories = [
                ['name' => 'HP & Smartphone', 'slug' => 'hp-smartphone', 'desc' => 'Berbagai pilihan Hp terbaru dan berkualitas', 'assets' => 'foto/hp.png'],
                ['name' => 'Laptop', 'slug' => 'laptop', 'desc' => 'Laptop untuk bekerja, belajar dan lain lain', 'assets' => 'foto/image-removebg-preview.png'],
                ['name' => 'Kamera', 'slug' => 'kamera', 'desc' => 'Kamera yang berkualitas dan canggih', 'assets' => 'foto/camera.png'],
                ['name' => 'Playstation', 'slug' => 'playstation', 'desc' => 'Konsol gaming untuk hiburan dan event', 'assets' => 'foto/playstation.png'],
            ];
        @endphp
        
        @foreach($categories as $cat)
        <div class="bg-nexus-green rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="text-lg font-bold mb-3">{{ $cat['name'] }}</h4>
                <p class="text-sm text-gray-200 leading-relaxed mb-4 max-w-[60%]">{{ $cat['desc'] }}</p>
                <a href="{{ route('katalog.category', $cat['slug']) }}" 
                   class="inline-block bg-white text-nexus-green text-xs font-bold py-2 px-6 rounded-full hover:bg-gray-100 transition shadow-md">
                   LIHAT ASET
                </a>
            </div>
            <img src="{{ asset($cat['assets']) }}" class="absolute -bottom-2 -right-2 w-32 h-32 object-contain drop-shadow-xl">
        </div>
        @endforeach
    </div>

    <!-- ASET TERSEDIA SECTION -->
    <div class="pb-6">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Aset Tersedia</h2>
        </div>
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Rekomendasi</h4>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            @forelse($assets->take(5) as $item)
            <div class="bg-nexus-green rounded-2xl p-5 text-white shadow-lg flex flex-col relative">
                <span class="absolute top-4 left-4 bg-white text-nexus-green text-xs font-bold px-3 py-1 rounded-lg">Tersedia</span>
                
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
                
                <div class="flex-1 flex flex-col text-center">
                    <h5 class="text-sm font-bold mb-2 leading-tight px-2">{{ Str::limit($item->name, 30) }}</h5>
                    <p class="text-xs text-gray-200 mb-1">stock tersedia {{ $item->stock }} unit</p>
                    <p class="text-xs text-gray-300 mb-4">minimal pinjam 1 hari</p>
                    
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
@endsection