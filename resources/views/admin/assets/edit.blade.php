@extends('layouts.admin')

@section('title', 'Edit Aset')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Edit Aset</h1>
        <p class="text-gray-600 mt-1">Perbarui informasi aset</p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.assets.update', $asset) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-lg p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Nama Aset -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Aset <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $asset->name) }}" 
                       required
                       placeholder="Contoh: Laptop Intel Core i5-1135G7"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nexus-green focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="category" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nexus-green focus:border-transparent @error('category') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    <option value="hp-smartphone" {{ old('category', $asset->category) == 'hp-smartphone' ? 'selected' : '' }}>HP & Smartphone</option>
                    <option value="laptop" {{ old('category', $asset->category) == 'laptop' ? 'selected' : '' }}>Laptop</option>
                    <option value="kamera" {{ old('category', $asset->category) == 'kamera' ? 'selected' : '' }}>Kamera</option>
                    <option value="playstation" {{ old('category', $asset->category) == 'playstation' ? 'selected' : '' }}>PlayStation</option>
                </select>
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Jumlah Stok <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       name="stock" 
                       value="{{ old('stock', $asset->stock) }}" 
                       required
                       min="0"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nexus-green focus:border-transparent @error('stock') border-red-500 @enderror">
                @error('stock')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

           <!-- Status -->
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Status <span class="text-red-500">*</span>
    </label>
    <select name="status" 
            required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nexus-green focus:border-transparent @error('status') border-red-500 @enderror">
        <option value="available" {{ old('status', $asset->status) == 'available' ? 'selected' : '' }}> Tersedia</option>
        <option value="unavailable" {{ old('status', $asset->status) == 'unavailable' ? 'selected' : '' }}> Tidak Tersedia</option>
    </select>
    @error('status')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Upload Foto Aset
                </label>
                
                <!-- Tampilkan Gambar Saat Ini -->
                @if($asset->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $asset->image) }}" 
                             alt="{{ $asset->name }}" 
                             class="w-48 h-48 object-cover rounded-lg shadow-md">
                    </div>
                @endif
                
                <!-- Upload Gambar Baru -->
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-nexus-green transition">
                    <input type="file" 
                           name="image" 
                           id="image"
                           accept="image/*"
                           class="hidden"
                           onchange="previewImage(this)">
                    <label for="image" class="cursor-pointer">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm text-gray-600">Klik untuk upload foto baru</span>
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                        <p class="text-xs text-gray-500">Format: JPG, PNG, GIF (Max 2MB)</p>
                    </label>
                    <img id="preview" class="mt-4 max-h-48 mx-auto rounded-lg hidden">
                </div>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Spesifikasi -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Spesifikasi Detail <span class="text-red-500">*</span>
                </label>
                <textarea name="specification" 
                          rows="4" 
                          required
                          placeholder="Contoh: Intel Core i5-1135G7 2.40GHz, 8GB RAM, 256GB SSD, Windows 10 Home, Layar 14 inch FHD"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-nexus-green focus:border-transparent @error('specification') border-red-500 @enderror">{{ old('specification', $asset->specification) }}</textarea>
                @error('specification')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.assets.index') }}" 
               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-semibold">
                Batal
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-nexus-green text-white rounded-lg hover:bg-nexus-light transition font-semibold shadow-lg">
                Update Aset
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection