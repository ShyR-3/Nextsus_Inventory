@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Laporan & Statistik</h1>
            <p class="text-gray-600 mt-1">Ringkasan data aset dan peminjaman sistem Nexus Inventory</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="bg-nexus-green text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-semibold flex items-center gap-2 shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Laporan
            </button>
        </div>
    </div>

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-nexus-green to-nexus-light rounded-xl p-6 text-white shadow-lg mb-8">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-1">Laporan Periode {{ now()->format('d F Y') }}</h3>
                <p class="text-sm text-white/90">Data diperbarui secara real-time dari database sistem</p>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-nexus-green">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Aset</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalAssets }}</p>
                    <p class="text-xs text-gray-500 mt-1">Semua kategori</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Stok</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalStock }}</p>
                    <p class="text-xs text-gray-500 mt-1">Unit fisik tersedia</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Peminjaman</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalBorrowings }}</p>
                    <p class="text-xs text-gray-500 mt-1">Semua transaksi</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
                    <p class="text-xs text-gray-500 mt-1">User terdaftar</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <!-- Status Peminjaman -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-nexus-green px-6 py-4">
                <h3 class="text-white font-bold text-lg">Status Peminjaman</h3>
                <p class="text-white/80 text-sm">Distribusi peminjaman berdasarkan status</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($statusBreakdown as $status)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-gray-700">{{ $status['label'] }}</span>
                            <span class="text-sm font-bold text-gray-800">{{ $status['count'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="h-3 rounded-full transition-all duration-500 {{ $status['color'] }}" 
                                 style="width: {{ $status['percentage'] }}%"></div>
                        </div>
                        <div class="text-right text-xs text-gray-500 mt-1">{{ $status['percentage'] }}%</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Aset per Kategori -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-nexus-green px-6 py-4">
                <h3 class="text-white font-bold text-lg">Aset per Kategori</h3>
                <p class="text-white/80 text-sm">Jumlah aset berdasarkan kategori</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($categoryBreakdown as $category)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-nexus-green/10 rounded-lg flex items-center justify-center">
                                @if($category['category'] === 'hp-smartphone')
                                    <svg class="w-5 h-5 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                @elseif($category['category'] === 'laptop')
                                    <svg class="w-5 h-5 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                @elseif($category['category'] === 'kamera')
                                    <svg class="w-5 h-5 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                @else
                                    <svg class="w-5 h-5 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @endif
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">{{ $category['label'] }}</div>
                                <div class="text-xs text-gray-500">{{ $category['stock'] }} unit stok</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-nexus-green">{{ $category['count'] }}</div>
                            <div class="text-xs text-gray-500">aset</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Top Assets & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <!-- Top 5 Aset Paling Sering Dipinjam -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-nexus-green px-6 py-4">
                <h3 class="text-white font-bold text-lg">Top 5 Aset Populer</h3>
                <p class="text-white/80 text-sm">Aset yang paling sering dipinjam</p>
            </div>
            <div class="p-6">
                @if($topAssets->count() > 0)
                <div class="space-y-3">
                    @foreach($topAssets as $index => $asset)
                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white
                            @if($index === 0) bg-yellow-500
                            @elseif($index === 1) bg-gray-400
                            @elseif($index === 2) bg-orange-600
                            @else bg-gray-300 @endif">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800">{{ $asset->name }}</div>
                            <div class="text-xs text-gray-500">{{ $asset->category }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-nexus-green">{{ $asset->borrowings_count }}</div>
                            <div class="text-xs text-gray-500">peminjaman</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="text-sm">Belum ada data peminjaman</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-nexus-green px-6 py-4">
                <h3 class="text-white font-bold text-lg">Aktivitas Terbaru</h3>
                <p class="text-white/80 text-sm">Peminjaman terakhir dalam sistem</p>
            </div>
            <div class="p-6">
                @if($recentActivity->count() > 0)
                <div class="space-y-3">
                    @foreach($recentActivity as $activity)
                    <div class="flex items-start gap-3 p-3 border-l-4 
                        @if($activity->status === 'pending') border-yellow-500 bg-yellow-50
                        @elseif($activity->status === 'approved') border-blue-500 bg-blue-50
                        @elseif($activity->status === 'borrowed') border-orange-500 bg-orange-50
                        @elseif($activity->status === 'returned') border-green-500 bg-green-50
                        @else border-red-500 bg-red-50 @endif rounded-r-lg">
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800 text-sm">{{ $activity->user->name ?? 'Unknown' }}</div>
                            <div class="text-xs text-gray-600 mt-1">
                                Meminjam <span class="font-semibold">{{ $activity->asset->name ?? 'Unknown' }}</span>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $activity->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                @if($activity->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($activity->status === 'approved') bg-blue-100 text-blue-800
                                @elseif($activity->status === 'borrowed') bg-orange-100 text-orange-800
                                @elseif($activity->status === 'returned') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm">Belum ada aktivitas</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Summary Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="bg-nexus-green px-6 py-4">
            <h3 class="text-white font-bold text-lg">Ringkasan Peminjaman Bulanan</h3>
            <p class="text-white/80 text-sm">Statistik peminjaman 6 bulan terakhir</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bulan</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Pengajuan</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Disetujui</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Ditolak</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Dikembalikan</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Tingkat Persetujuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($monthlyStats as $stat)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $stat['month'] }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-700">{{ $stat['total'] }}</td>
                        <td class="px-6 py-4 text-sm text-center text-green-600 font-semibold">{{ $stat['approved'] }}</td>
                        <td class="px-6 py-4 text-sm text-center text-red-600 font-semibold">{{ $stat['rejected'] }}</td>
                        <td class="px-6 py-4 text-sm text-center text-blue-600 font-semibold">{{ $stat['returned'] }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center gap-2">
                                <div class="w-20 bg-gray-200 rounded-full h-2">
                                    <div class="bg-nexus-green h-2 rounded-full" style="width: {{ $stat['approval_rate'] }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-700">{{ $stat['approval_rate'] }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Note -->
    <div class="bg-nexus-green rounded-xl p-4 flex items-center gap-3 text-white">
        <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-nexus-green" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-sm">Laporan ini digenerate secara otomatis dari database. Gunakan tombol "Cetak Laporan" untuk menyimpan atau mencetak laporan ini.</p>
    </div>
</div>

<!-- Print Styles -->
<style>
@media print {
    body * {
        visibility: hidden;
    }
    .p-8, .p-8 * {
        visibility: visible;
    }
    .p-8 {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    button, .bg-nexus-green.rounded-xl.p-4 {
        display: none !important;
    }
}
</style>
@endsection