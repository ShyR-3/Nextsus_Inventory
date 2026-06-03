<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Nexus Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nexus: {
                            light: '#E8F5E9',
                            DEFAULT: '#2E7D32',
                            dark: '#1B5E20',
                            darker: '#0D3310',
                        },
                        bg: '#F3F4F6',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-bg min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">
        
        <!-- Logo -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center gap-2 bg-nexus-darker text-white px-4 py-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="font-bold">NEXUS</span>
            </div>
        </div>

        <!-- Header -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Buat Akun Baru</h2>
        <p class="text-center text-gray-500 text-sm mb-6">Daftar untuk mulai meminjam aset</p>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
            @csrf
            
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nexus-light focus:border-nexus-DEFAULT outline-none"
                       placeholder="John Doe">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nexus-light focus:border-nexus-DEFAULT outline-none"
                       placeholder="nama@email.com">
            </div>

            <!-- Phone (Optional) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp (Opsional)</label>
                <input type="tel" name="phone" value="{{ old('phone') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nexus-light focus:border-nexus-DEFAULT outline-none"
                       placeholder="081234567890">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nexus-light focus:border-nexus-DEFAULT outline-none"
                       placeholder="••••••••">
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nexus-light focus:border-nexus-DEFAULT outline-none"
                       placeholder="••••••••">
            </div>

            <!-- Address (Optional) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat (Opsional)</label>
                <textarea name="address" rows="2"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nexus-light focus:border-nexus-DEFAULT outline-none resize-none"
                          placeholder="Jl. Contoh No. 123, Kota">{{ old('address') }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-nexus-DEFAULT text-white font-semibold py-3 rounded-xl hover:bg-nexus-dark transition duration-300">
                Daftar Sekarang
            </button>
        </form>

        <!-- Login Link -->
        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-nexus-DEFAULT font-semibold hover:underline">Masuk di sini</a>
        </p>

    </div>

</body>
</html>