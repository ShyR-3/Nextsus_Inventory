<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nexus Inventory</title>
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
                        bg: '#F3F4F6', // Warna background luar card
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
        .asset-float { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
    </style>
</head>
<body class="bg-bg min-h-screen flex items-center justify-center p-4 lg:p-8">

    <!-- CARD CONTAINER (Sesuai Figma) -->
    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row">
        
        <!-- SISI KIRI: Branding & Gambar -->
        <div class="w-full lg:w-1/2 bg-white p-8 lg:p-12 flex flex-col justify-center relative">
            
            <!-- Logo -->
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 bg-nexus-darker text-white px-4 py-2 rounded-lg shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <div>
                        <div class="text-lg font-bold tracking-wide">NEXUS</div>
                        <div class="text-[10px] tracking-widest opacity-80">INVENTORY</div>
                    </div>
                </div>
            </div>

            <!-- Teks -->
            <div class="mb-8 lg:mb-12">
                <h1 class="text-3xl lg:text-4xl font-bold text-nexus-darker mb-3 leading-tight">
                    Sistem peminjaman aset <span class="text-nexus-DEFAULT">TERPERCAYA</span>
                </h1>
                <p class="text-gray-600 text-sm lg:text-base">
                    pinjam aset dengan mudah, kelola dengan efisien, dan dukung setiap pekerjaan & kegiatan anda
                </p>
            </div>

            <!-- GAMBAR ASET (Overlap & Rapat) -->
            <div class="relative mt-auto w-full">
                <!-- Ellipse Hijau -->
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[110%] h-24 lg:h-32 bg-nexus-DEFAULT rounded-[50%] opacity-20 blur-md"></div>
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[100%] h-20 lg:h-28 bg-nexus-darker rounded-[50%]"></div>

                <!-- Grup Gambar -->
                <div class="relative flex items-end justify-center -space-x-6 lg:-space-x-10 px-4 pt-8 lg:pt-12">
                    
                    <!-- Laptop -->
                    <div class="asset-float transform -rotate-12 hover:rotate-0 transition-all duration-500 z-10">
                        <img src="{{ asset('foto/image-removebg-preview.png') }}" alt="Laptop" class="w-28 lg:w-40 drop-shadow-2xl object-contain">
                    </div>
                    
                    <!-- Camera -->
                    <div class="asset-float transform hover:rotate-0 transition-all duration-500 z-20">
                        <img src="{{ asset('foto/camera.png') }}" alt="Camera" class="w-36 lg:w-48 drop-shadow-2xl object-contain">
                    </div>
                    
                    <!-- Smartphone -->
                    <div class="asset-float transform rotate-6 hover:rotate-0 transition-all duration-500 z-10">
                        <img src="{{ asset('foto/hp.png') }}" alt="Smartphone" class="w-24 lg:w-36 drop-shadow-2xl object-contain">
                    </div>
                    
                    <<!-- PlayStation -->
<div class="asset-float transform rotate-12 hover:rotate-0 transition-all duration-500 z-10">
    <img src="{{ asset('foto/playstation.png') }}" 
         alt="PlayStation" 
         class="w-28 lg:w-40 drop-shadow-2xl object-contain">
</div>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: Form Login -->
        <div class="w-full lg:w-1/2 bg-nexus-darker p-8 lg:p-16 flex items-center justify-center">
            <div class="w-full max-w-md">
                
                <!-- Header Form -->
                <div class="text-center mb-8 lg:mb-12">
                    <div class="hidden lg:flex justify-center mb-6">
                        <div class="text-3xl font-bold text-white tracking-wider">NEXUS</div>
                    </div>
                    <h2 class="text-2xl lg:text-3xl font-bold text-white mb-2">Masuk ke Akun anda</h2>
                    <p class="text-gray-400 text-sm">kelola peminjaman aset dengan mudah dan aman</p>
                </div>

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-6 bg-red-500 bg-opacity-20 border border-red-400 text-white px-4 py-3 rounded-xl text-sm">
                        @foreach($errors->all() as $error) <p>• {{ $error }}</p> @endforeach
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </span>
                            <input type="email" name="email" required class="w-full pl-12 pr-4 py-3 bg-gray-100 rounded-xl text-gray-900 focus:ring-2 focus:ring-nexus-light outline-none" placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Kata sandi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input type="password" name="password" required class="w-full pl-12 pr-4 py-3 bg-gray-100 rounded-xl text-gray-900 focus:ring-2 focus:ring-nexus-light outline-none" placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center text-gray-300 cursor-pointer">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-nexus focus:ring-nexus"> Ingat saya
                        </label>
                        <a href="#" class="text-gray-400 hover:text-white">lupa kata sandi?</a>
                    </div>

                    <!-- Button Login -->
                    <button type="submit" class="w-full bg-nexus-light text-nexus-darker font-bold py-3 rounded-xl hover:bg-white transition duration-300">
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-nexus-darker text-gray-400">atau masuk dengan</span>
                    </div>
                </div>

               <!-- Google Login -->
<a href="http://127.0.0.1:8000/auth/google" 
   class="w-full flex items-center justify-center gap-3 bg-white text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-50 transition duration-300 cursor-pointer no-underline">
    <svg class="w-5 h-5" viewBox="0 0 24 24">
        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
    </svg>
    <span>Continue with Google</span>
</a>

       <!-- Footer -->
<p class="mt-8 text-center text-sm text-gray-400">
    Belum punya akun? 
    <a href="{{ route('register') }}" class="text-white font-semibold hover:underline">Daftar di sini</a>
</p>      
            </div>
        </div>

    </div>

</body>
</html>