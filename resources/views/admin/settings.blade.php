@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Pengaturan</h1>
        <p class="text-gray-600 mt-1">Kelola pengaturan akun dan sistem Anda</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <p class="text-green-700 font-semibold">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Tab Navigation -->
    <div class="mb-6 border-b border-gray-200">
        <nav class="flex gap-6">
            <button onclick="showTab('profile')" id="tab-profile" class="tab-button pb-4 px-1 border-b-2 border-nexus-green text-nexus-green font-semibold text-sm">
                Profil Admin
            </button>
            <button onclick="showTab('password')" id="tab-password" class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-semibold text-sm">
                Ubah Password
            </button>
            <button onclick="showTab('application')" id="tab-application" class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-semibold text-sm">
                Pengaturan Aplikasi
            </button>
            <button onclick="showTab('system')" id="tab-system" class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-semibold text-sm">
                Informasi Sistem
            </button>
        </nav>
    </div>

    <!-- Tab Content -->
    <div class="space-y-6">
        
        <!-- TAB 1: PROFIL ADMIN -->
        <div id="content-profile" class="tab-content">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Profil Admin</h3>
                    <p class="text-sm text-gray-600 mt-1">Kelola informasi profil Anda</p>
                </div>
                <form action="{{ route('admin.settings.update-profile') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex items-center gap-6 mb-6 pb-6 border-b border-gray-200">
                        <div class="w-24 h-24 rounded-full bg-nexus-green flex items-center justify-center text-white text-3xl font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h4>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-nexus-green/10 text-nexus-green">
                                Administrator
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon (Opsional)</label>
                            <input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}" placeholder="08xxxxxxxxxx"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                        <button type="reset" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                            Reset
                        </button>
                        <button type="submit" class="px-6 py-2 bg-nexus-green text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TAB 2: UBAH PASSWORD -->
        <div id="content-password" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Ubah Password</h3>
                    <p class="text-sm text-gray-600 mt-1">Perbarui password akun Anda secara berkala untuk keamanan</p>
                </div>
                <form action="{{ route('admin.settings.update-password') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="max-w-xl space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Lama</label>
                            <input type="password" name="current_password" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="new_password" required minlength="8"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                        </div>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-yellow-800">Perhatian!</p>
                                    <p class="text-xs text-yellow-700 mt-1">Setelah mengubah password, Anda akan diminta login kembali.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                            <button type="reset" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                                Batal
                            </button>
                            <button type="submit" class="px-6 py-2 bg-nexus-green text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-md">
                                Ubah Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- TAB 3: PENGATURAN APLIKASI -->
        <div id="content-application" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Pengaturan Aplikasi</h3>
                    <p class="text-sm text-gray-600 mt-1">Konfigurasi umum sistem Nexus Inventory</p>
                </div>
                <form action="{{ route('admin.settings.update-app') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Aplikasi</label>
                            <input type="text" name="app_name" value="Nexus Inventory"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Zona Waktu</label>
                                <select name="timezone" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                                    <option value="Asia/Jakarta" selected>WIB (Asia/Jakarta)</option>
                                    <option value="Asia/Makassar">WITA (Asia/Makassar)</option>
                                    <option value="Asia/Jayapura">WIT (Asia/Jayapura)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Bahasa</label>
                                <select name="language" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                                    <option value="id" selected>Bahasa Indonesia</option>
                                    <option value="en">English</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Maksimal Durasi Peminjaman (Hari)</label>
                            <input type="number" name="max_borrow_days" value="30" min="1"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Batas maksimal hari peminjaman aset</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-800 mb-3">Notifikasi Email</h4>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" name="notify_new_borrowing" checked class="w-4 h-4 text-nexus-green rounded focus:ring-nexus-green">
                                    <span class="ml-3 text-sm text-gray-700">Kirim notifikasi saat ada pengajuan peminjaman baru</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="notify_return_reminder" checked class="w-4 h-4 text-nexus-green rounded focus:ring-nexus-green">
                                    <span class="ml-3 text-sm text-gray-700">Kirim pengingat pengembalian 1 hari sebelum jatuh tempo</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="notify_low_stock" class="w-4 h-4 text-nexus-green rounded focus:ring-nexus-green">
                                    <span class="ml-3 text-sm text-gray-700">Kirim notifikasi saat stok aset menipis</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                            <button type="reset" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                                Reset
                            </button>
                            <button type="submit" class="px-6 py-2 bg-nexus-green text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-md">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- TAB 4: INFORMASI SISTEM -->
        <div id="content-system" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Informasi Sistem</h3>
                    <p class="text-sm text-gray-600 mt-1">Detail teknis sistem Nexus Inventory</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Informasi Aplikasi -->
                        <div class="bg-gradient-to-br from-nexus-green to-nexus-light rounded-xl p-6 text-white">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Nexus Inventory</h4>
                                    <p class="text-xs text-white/80">Versi 1.0.0</p>
                                </div>
                            </div>
                            <p class="text-sm text-white/90 leading-relaxed">
                                Sistem Informasi Peminjaman Aset berbasis web untuk Nextsus Inventory.
                            </p>
                        </div>

                        <!-- Spesifikasi Teknis -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                </svg>
                                Spesifikasi Teknis
                            </h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                    <span class="text-sm text-gray-600">Framework</span>
                                    <span class="text-sm font-semibold text-gray-800">Laravel {{ app()->version() }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                    <span class="text-sm text-gray-600">PHP Version</span>
                                    <span class="text-sm font-semibold text-gray-800">{{ phpversion() }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                    <span class="text-sm text-gray-600">Database</span>
                                    <span class="text-sm font-semibold text-gray-800">MySQL 8.0</span>
                                </div>
                                <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                    <span class="text-sm text-gray-600">CSS Framework</span>
                                    <span class="text-sm font-semibold text-gray-800">Tailwind CSS</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Environment</span>
                                    <span class="text-sm font-semibold text-gray-800">{{ config('app.env') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Database -->
                    <div class="mt-6 bg-gray-50 rounded-xl p-6">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                            </svg>
                            Statistik Database
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-white rounded-lg p-4 text-center">
                                <p class="text-3xl font-bold text-nexus-green">{{ $stats['total_assets'] }}</p>
                                <p class="text-xs text-gray-600 mt-1">Total Aset</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center">
                                <p class="text-3xl font-bold text-blue-600">{{ $stats['total_users'] }}</p>
                                <p class="text-xs text-gray-600 mt-1">Total User</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center">
                                <p class="text-3xl font-bold text-orange-600">{{ $stats['total_borrowings'] }}</p>
                                <p class="text-xs text-gray-600 mt-1">Total Peminjaman</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center">
                                <p class="text-3xl font-bold text-purple-600">{{ $stats['total_categories'] }}</p>
                                <p class="text-xs text-gray-600 mt-1">Kategori Aset</p>
                            </div>
                        </div>
                    </div>

                    <!-- Server Info -->
                    <div class="mt-6 bg-gray-50 rounded-xl p-6">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                            </svg>
                            Informasi Server
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Server OS</span>
                                <span class="text-sm font-semibold text-gray-800">{{ PHP_OS }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Server Software</span>
                                <span class="text-sm font-semibold text-gray-800">{{ request()->server('SERVER_SOFTWARE') ?? 'Unknown' }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Memory Limit</span>
                                <span class="text-sm font-semibold text-gray-800">{{ ini_get('memory_limit') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Upload Max Size</span>
                                <span class="text-sm font-semibold text-gray-800">{{ ini_get('upload_max_filesize') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex flex-wrap gap-3">
                        <button onclick="clearCache()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-semibold text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Clear Cache
                        </button>
                        <button onclick="exportData()" class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition font-semibold text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Data
                        </button>
                        <button onclick="backupData()" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-semibold text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Backup Database
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Info Note -->
    <div class="mt-6 bg-nexus-green rounded-xl p-4 flex items-center gap-3 text-white">
        <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-nexus-green" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-sm">Pengaturan ini hanya dapat diubah oleh administrator. Perubahan akan berdampak pada seluruh sistem.</p>
    </div>
</div>

<!-- JavaScript for Tab Switching -->
<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Reset all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-nexus-green', 'text-nexus-green');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Activate selected tab button
    const activeButton = document.getElementById('tab-' + tabName);
    activeButton.classList.remove('border-transparent', 'text-gray-500');
    activeButton.classList.add('border-nexus-green', 'text-nexus-green');
}

function clearCache() {
    if (confirm('Apakah Anda yakin ingin membersihkan cache sistem?')) {
        alert('Cache berhasil dibersihkan! (Fitur ini akan diimplementasikan)');
    }
}

function exportData() {
    if (confirm('Apakah Anda yakin ingin mengekspor semua data?')) {
        alert('Data berhasil diekspor! (Fitur ini akan diimplementasikan)');
    }
}

function backupData() {
    if (confirm('Apakah Anda yakin ingin melakukan backup database?')) {
        alert('Backup database berhasil dibuat! (Fitur ini akan diimplementasikan)');
    }
}
</script>
@endsection