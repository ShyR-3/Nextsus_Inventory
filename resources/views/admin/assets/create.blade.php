@extends('layouts.admin')

@section('title', 'Tambah Aset Baru')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Aset Baru</h1>
        <p class="text-gray-600 mt-1">Isi form di bawah untuk menambahkan aset baru</p>
    </div>

    <form action="{{ route('admin.assets.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-lg p-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Nama Aset -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Aset *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nexus-green">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                <select name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                    <option value="">Pilih Kategori</option>
                    <option value="hp-smartphone">HP & Smartphone</option>
                    <option value="laptop">Laptop</option>
                    <option value="kamera">Kamera</option>
                    <option value="playstation">PlayStation</option>
                </select>
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Stok *</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            </div>

            <!-- Status -->
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Status <span class="text-red-500">*</span>
    </label>
    <select name="status" 
            required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nexus-green focus:border-transparent @error('status') border-red-500 @enderror">
        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}> Tersedia</option>
        <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}> Tidak Tersedia</option>
    </select>
    @error('status')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Gambar</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max 2MB)</p>
            </div>

            <!-- Spesifikasi -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Spesifikasi *</label>
                <textarea name="specification" rows="4" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg">{{ old('specification') }}</textarea>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('admin.assets.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg">Batal</a>
            <button type="submit" class="px-6 py-3 bg-nexus-green text-white rounded-lg font-semibold">Simpan Aset</button>
        </div>
    </form>
</div>
@endsection