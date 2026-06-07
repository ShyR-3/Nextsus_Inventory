<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    /**
     * Tampilkan daftar semua aset
     */
    public function index()
    {
        $assets = Asset::latest()->paginate(10);
        return view('admin.assets.index', compact('assets'));
    }

    /**
     * Tampilkan form tambah aset
     */
    public function create()
    {
        return view('admin.assets.create');
    }

    /**
     * Simpan aset baru ke database
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|in:hp-smartphone,laptop,kamera,playstation',
        'specification' => 'required|string',
        'stock' => 'required|integer|min:0',
        'status' => 'required|in:available,unavailable',  // ✅ Hanya 2 opsi
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('assets', 'public');
    }

    Asset::create($validated);

    return redirect()->route('admin.assets.index')
        ->with('success', 'Aset berhasil ditambahkan!');
}

    /**
     * Tampilkan detail & form edit aset
     */
    public function edit(Asset $asset)
    {
        return view('admin.assets.edit', compact('asset'));
    }

    /**
     * Update aset di database
     */
    public function update(Request $request, Asset $asset)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:hp-smartphone,laptop,kamera,playstation',
            'specification' => 'required|string',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,maintenance,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($asset->image) {
                Storage::disk('public')->delete($asset->image);
            }
            // Simpan gambar baru
            $validated['image'] = $request->file('image')->store('assets', 'public');
        }

        // 3. Update database
        $asset->update($validated);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('admin.assets.index')
            ->with('success', 'Aset berhasil diperbarui!');
    }

    /**
     * Hapus aset dari database
     */
    public function destroy(Asset $asset)
    {
        // 1. Hapus gambar jika ada
        if ($asset->image) {
            Storage::disk('public')->delete($asset->image);
        }

        // 2. Hapus data dari database
        $asset->delete();

        // 3. Redirect dengan pesan sukses
        return redirect()->route('admin.assets.index')
            ->with('success', 'Aset berhasil dihapus!');
    }
}