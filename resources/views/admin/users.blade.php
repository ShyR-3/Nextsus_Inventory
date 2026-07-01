@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Pengguna</h1>
            <p class="text-gray-600 mt-1">Kelola semua pengguna yang terdaftar dalam sistem</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white rounded-lg px-4 py-2 shadow-sm border border-gray-200">
                <span class="text-sm text-gray-600">Total Pengguna:</span>
                <span class="text-lg font-bold text-nexus-green ml-2">{{ $users->total() }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-nexus-green">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $users->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-nexus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Pengguna Aktif</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $users->where('email_verified_at', '!=', null)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Pengguna Baru (7 Hari)</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
        <form method="GET" action="{{ route('admin.users') }}" class="flex gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama atau email pengguna..." 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-nexus-green focus:border-transparent">
            </div>
            <button type="submit" class="bg-nexus-green text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.users') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition font-semibold">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Daftar Pengguna</h3>
                <p class="text-sm text-gray-600 mt-1">Menampilkan {{ $users->count() }} dari {{ $users->total() }} pengguna</p>
            </div>
        </div>

        @if($users->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $user->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-nexus-green flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">User</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <div>{{ $user->email }}</div>
                            @if($user->email_verified_at)
                                <div class="text-xs text-green-600 flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Terverifikasi
                                </div>
                            @else
                                <div class="text-xs text-yellow-600 flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Belum verifikasi
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div>{{ $user->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->email_verified_at)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Belum Aktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-semibold" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button class="text-green-600 hover:text-green-800 text-sm font-semibold" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-800 text-sm font-semibold" title="Hapus" onclick="confirmDelete({{ $user->id }})">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
        @endif

        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">
                @if(request('search'))
                    Tidak Ada Hasil Pencarian
                @else
                    Belum Ada Pengguna Terdaftar
                @endif
            </h3>
            <p class="text-gray-500 mb-6">
                @if(request('search'))
                    Tidak ada pengguna yang cocok dengan pencarian "{{ request('search') }}"
                @else
                    Belum ada pengguna yang terdaftar dalam sistem
                @endif
            </p>
            @if(request('search'))
                <a href="{{ route('admin.users') }}" class="inline-block bg-nexus-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                    Reset Pencarian
                </a>
            @endif
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
        <p class="text-sm">Pengguna dapat mendaftar melalui halaman registrasi. Admin dapat mengelola data pengguna dari halaman ini.</p>
    </div>
</div>

<!-- Delete Confirmation Script -->
<script>
function confirmDelete(userId) {
    if (confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')) {
        // TODO: Implement delete functionality
        alert('Fitur hapus pengguna akan segera diimplementasikan');
    }
}
</script>
@endsection