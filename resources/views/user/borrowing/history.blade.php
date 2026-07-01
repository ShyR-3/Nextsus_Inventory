@extends('layouts.user')

@section('title', 'Riwayat Peminjaman')

@section('content')
<!-- HEADER -->
<header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
    <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-200 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
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
            <svg class="w-4 h-4 text-nexus-green" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-sm">Status peminjaman akan diperbarui secara real-time oleh admin</p>
    </div>

</div>
@endsection