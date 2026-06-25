@extends('layouts.admin')

@section('title', 'Peminjaman')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Peminjaman</h1>
        <p class="text-gray-600 mt-1">Kelola semua peminjaman aset</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-4">
            <p class="text-sm text-gray-600">Pending</p>
            <p class="text-2xl font-bold text-yellow-700">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-green-50 border-l-4 border-green-500 rounded-xl p-4">
            <p class="text-sm text-gray-600">Disetujui</p>
            <p class="text-2xl font-bold text-green-700">{{ $stats['approved'] }}</p>
        </div>
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-xl p-4">
            <p class="text-sm text-gray-600">Dipinjam</p>
            <p class="text-2xl font-bold text-blue-700">{{ $stats['borrowed'] }}</p>
        </div>
        <div class="bg-gray-50 border-l-4 border-gray-500 rounded-xl p-4">
            <p class="text-sm text-gray-600">Dikembalikan</p>
            <p class="text-2xl font-bold text-gray-700">{{ $stats['returned'] }}</p>
        </div>
        <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-4">
            <p class="text-sm text-gray-600">Ditolak</p>
            <p class="text-2xl font-bold text-red-700">{{ $stats['rejected'] }}</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
        <form method="GET" class="flex gap-3">
            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Peminjam</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aset</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Keperluan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($borrowings as $b)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium">#{{ $b->id }}</td>
                    <td class="px-6 py-4 text-sm">{{ $b->user->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $b->asset->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $b->borrow_date->format('d M Y') }} - {{ $b->return_date->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm">{{ Str::limit($b->notes, 30) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $b->status_badge }}">
                            {{ $b->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($b->status === 'pending')
                            <div class="flex gap-2">
                                <form action="{{ route('admin.borrowings.approve', $b->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-semibold">Approve</button>
                                </form>
                                <form action="{{ route('admin.borrowings.reject', $b->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">Reject</button>
                                </form>
                            </div>
                        @elseif($b->status === 'approved')
                            <form action="{{ route('admin.borrowings.borrowed', $b->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Tandai Dipinjam</button>
                            </form>
                        @elseif($b->status === 'borrowed')
                            <form action="{{ route('admin.borrowings.returned', $b->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-gray-800 text-sm font-semibold">Tandai Dikembalikan</button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                        Belum ada data peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $borrowings->links() }}
    </div>
</div>
@endsection