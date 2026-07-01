@extends('layouts.user')

@section('title', 'Pengembalian Aset')

@section('content')
<!-- HEADER -->
<header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
    <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-200 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1 class="text-white font-bold text-lg">Pengembalian Aset</h1>
</header>

<!-- CONTENT AREA -->
<div class="flex-1 overflow-y-auto p-6">
    
    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Aset yang Perlu Dikembalikan</h2>
        <p class="text-gray-600 text-sm">Konfirmasi pengembalian aset yang sedang Anda pinjam</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-nexus-green">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Perlu Dikembalikan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Jatuh Tempo Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['due_today'] }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Terlambat</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['overdue'] }}</p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Akan Datang</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['upcoming'] }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Banner -->
    @if($stats['overdue'] > 0)
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <p class="text-sm font-semibold text-red-800">Perhatian!</p>
                <p class="text-xs text-red-700 mt-1">Anda memiliki {{ $stats['overdue'] }} aset yang sudah melewati batas waktu pengembalian. Segera kembalikan untuk menghindari sanksi.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Daftar Aset untuk Dikembalikan -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Daftar Pengembalian</h3>
                <p class="text-sm text-gray-600 mt-1">Konfirmasi pengembalian aset yang sedang Anda pinjam</p>
            </div>
            <span class="bg-nexus-green text-white text-xs font-bold px-3 py-1 rounded-full">
                {{ $returns->count() }} Aset
            </span>
        </div>

        @if($returns->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach($returns as $borrowing)
            @php
                $isOverdue = $borrowing->return_date < now();
                $daysLeft = now()->diffInDays($borrowing->return_date, false);
                $isDueToday = $borrowing->return_date->format('Y-m-d') === now()->format('Y-m-d');
            @endphp
            <div class="p-6 hover:bg-gray-50 transition">
                <div class="flex flex-col md:flex-row gap-6">
                    
                    <!-- Gambar Aset -->
                    <div class="w-full md:w-32 h-32 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        @if($borrowing->asset && $borrowing->asset->image)
                            <img src="{{ asset('storage/' . $borrowing->asset->image) }}" 
                                 alt="{{ $borrowing->asset->name }}" 
                                 class="max-h-full max-w-full object-contain p-2">
                        @else
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        @endif
                    </div>

                    <!-- Info Aset -->
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800">{{ $borrowing->asset->name ?? 'Aset tidak ditemukan' }}</h4>
                                <p class="text-sm text-gray-500">
                                    {{ $borrowing->asset->category ?? '-' }} • {{ $borrowing->asset->specification ?? '-' }}
                                </p>
                            </div>
                            
                            <!-- Status Badge -->
                            @if($isOverdue)
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    Terlambat
                                </span>
                            @elseif($isDueToday)
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Jatuh Tempo Hari Ini
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Tepat Waktu
                                </span>
                            @endif
                        </div>

                        <!-- Detail Info -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Tanggal Pinjam</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $borrowing->borrow_date->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Batas Kembali</p>
                                <p class="text-sm font-semibold {{ $isOverdue ? 'text-red-600' : ($isDueToday ? 'text-orange-600' : 'text-gray-800') }}">
                                    {{ $borrowing->return_date->format('d M Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Sisa Waktu</p>
                                @if($isOverdue)
                                    <p class="text-sm font-semibold text-red-600">
                                        Terlambat {{ abs($daysLeft) }} hari
                                    </p>
                                @elseif($isDueToday)
                                    <p class="text-sm font-semibold text-orange-600">
                                        Hari ini
                                    </p>
                                @else
                                    <p class="text-sm font-semibold text-green-600">
                                        {{ $daysLeft }} hari lagi
                                    </p>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Lokasi</p>
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $borrowing->location }}</p>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        @php
                            $totalDays = $borrowing->borrow_date->diffInDays($borrowing->return_date);
                            $usedDays = $borrowing->borrow_date->diffInDays(now());
                            $progress = $totalDays > 0 ? min(100, max(0, ($usedDays / $totalDays) * 100)) : 100;
                            $progressColor = $isOverdue ? 'bg-red-500' : ($progress > 75 ? 'bg-orange-500' : 'bg-nexus-green');
                        @endphp
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>Progress Peminjaman</span>
                                <span>{{ round($progress) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="{{ $progressColor }} h-2 rounded-full transition-all duration-500" 
                                     style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <form action="{{ route('user.returns.confirm', $borrowing->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" 
                                        class="w-full {{ $isOverdue ? 'bg-red-600 hover:bg-red-700' : 'bg-nexus-green hover:bg-green-700' }} text-white py-2.5 px-4 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Konfirmasi Pengembalian
                                </button>
                            </form>
                        </div>

                        <!-- Info Note -->
                        <div class="mt-3 bg-gray-50 rounded-lg p-3 flex items-start gap-2">
                            <svg class="w-4 h-4 text-nexus-green flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-xs text-gray-600">
                                Setelah konfirmasi, silakan serahkan aset ke admin untuk verifikasi kondisi. Stok akan diperbarui setelah admin memverifikasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Aset yang Perlu Dikembalikan</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">
                Anda tidak memiliki aset yang sedang dipinjam dengan status "Sedang Dipinjam". Aset yang sudah dikembalikan akan muncul di halaman Riwayat Peminjaman.
            </p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 bg-nexus-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Pinjam Aset Baru
                </a>
                <a href="{{ route('user.borrowing.history') }}" class="inline-flex items-center gap-2 bg-white border-2 border-nexus-green text-nexus-green px-6 py-3 rounded-lg font-semibold hover:bg-nexus-accent transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Lihat Riwayat
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Info Note -->
    <div class="mt-6 bg-nexus-green rounded-xl p-4 flex items-center gap-3 text-white">
        <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-nexus-green" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-sm">Halaman ini hanya menampilkan aset dengan status "Sedang Dipinjam". Setelah konfirmasi pengembalian, admin akan memverifikasi kondisi aset sebelum stok diperbarui.</p>
    </div>

</div>
@endsection