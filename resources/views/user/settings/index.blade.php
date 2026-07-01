@extends('layouts.user')

@section('title', 'Pengaturan')

@section('content')
<!-- HEADER -->
<header class="bg-nexus-green p-3 flex items-center gap-4 flex-shrink-0">
    <a href="{{ route('user.dashboard') }}" class="text-white hover:text-gray-200 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1 class="text-white font-bold text-lg">Pengaturan</h1>
</header>

<!-- CONTENT AREA -->
<div class="flex-1 overflow-y-auto p-6">
    
    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pengaturan Akun</h2>
        <p class="text-gray-600 text-sm">Kelola profil, password, dan preferensi notifikasi Anda</p>
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
                Profil
            </button>
            <button onclick="showTab('password')" id="tab-password" class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-semibold text-sm">
                Password
            </button>
            <button onclick="showTab('notifications')" id="tab-notifications" class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-semibold text-sm">
                Notifikasi
            </button>
        </nav>
    </div>

    <!-- Tab Content -->
    <div class="space-y-6">
        
        <!-- TAB 1: PROFIL -->
        <div id="content-profile" class="tab-content">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Profil Saya</h3>
                    <p class="text-sm text-gray-600 mt-1">Perbarui informasi profil Anda</p>
                </div>
                <form action="{{ route('user.settings.update-profile') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex items-center gap-6 mb-6 pb-6 border-b border-gray-200">
                        <div class="w-20 h-20 rounded-full bg-nexus-green flex items-center justify-center text-white text-2xl font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">{{ Auth::user()->name }}</h4>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                            <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-nexus-green/10 text-nexus-green">
                                User
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon (Opsional)</label>
                            <input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}" placeholder="08xxxxxxxxxx"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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

        <!-- TAB 2: PASSWORD -->
        <div id="content-password" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Ubah Password</h3>
                    <p class="text-sm text-gray-600 mt-1">Perbarui password akun Anda secara berkala untuk keamanan</p>
                </div>
                <form action="{{ route('user.settings.update-password') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="max-w-xl space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Lama</label>
                            <input type="password" name="current_password" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                            @error('current_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="new_password" required minlength="8"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
                            @error('new_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
                            @error('new_password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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

        <!-- TAB 3: NOTIFIKASI -->
        <div id="content-notifications" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Preferensi Notifikasi</h3>
                    <p class="text-sm text-gray-600 mt-1">Kelola cara Anda menerima notifikasi dari sistem</p>
                </div>
                <form action="{{ route('user.settings.update-notifications') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-800">Notifikasi Email</p>
                                <p class="text-sm text-gray-600">Terima update dan pengingat via email</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="email_notifications" value="1" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-nexus-green/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-nexus-green"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-800">Notifikasi SMS</p>
                                <p class="text-sm text-gray-600">Terima pengingat penting via SMS</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="sms_notifications" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-nexus-green/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-nexus-green"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-800">Pengingat Peminjaman</p>
                                <p class="text-sm text-gray-600">Notifikasi saat peminjaman disetujui admin</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="borrowing_reminder" value="1" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-nexus-green/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-nexus-green"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-800">Pengingat Pengembalian</p>
                                <p class="text-sm text-gray-600">Pengingat 1 hari sebelum batas pengembalian</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="return_reminder" value="1" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-nexus-green/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-nexus-green"></div>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                        <button type="reset" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                            Reset
                        </button>
                        <button type="submit" class="px-6 py-2 bg-nexus-green text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-md">
                            Simpan Preferensi
                        </button>
                    </div>
                </form>
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
        <p class="text-sm">Pengaturan ini hanya mempengaruhi akun Anda. Untuk mengubah pengaturan sistem, hubungi administrator.</p>
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
</script>
@endsection