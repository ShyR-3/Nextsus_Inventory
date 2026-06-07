@extends('layouts.admin')

@section('title', 'Kelola Aset')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kelola Aset</h1>
            <p class="text-gray-600 mt-1">Daftar semua aset yang tersedia</p>
        </div>
        <a href="{{ route('admin.assets.create') }}" 
           class="bg-nexus-green hover:bg-nexus-light text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition">
            + Tambah Aset Baru
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Assets Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Gambar</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama Aset</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Stok</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($assets as $asset)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($asset->image)
                            <img src="{{ asset('storage/' . $asset->image) }}" 
                                 alt="{{ $asset->name }}" 
                                 class="w-16 h-16 object-cover rounded-lg">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">{{ $asset->name }}</div>
                        <div class="text-sm text-gray-500">{{ Str::limit($asset->specification, 50) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                            {{ $asset->category_name ?? $asset->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-semibold {{ $asset->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $asset->stock }} unit
                        </span>
                    </td>
                    <td class="px-6 py-4">
    @if($asset->status === 'available')
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
            Tersedia
        </span>
    @else
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
             Tidak Tersedia
        </span>
    @endif
</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.assets.edit', $asset) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Edit</a>
                            <form action="{{ route('admin.assets.destroy', $asset) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus aset ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        Belum ada aset yang terdaftar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $assets->links() }}
    </div>
</div>
@endsection