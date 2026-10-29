<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daftar Mitra - Bakery Marketplace</title>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="bg-white font-sans m-0 p-0">

        <!-- SISI UTAMA: SPLIT SCREEN FULL LAYAR -->
        <div class="min-h-screen flex flex-col md:flex-row bg-white w-full">

            <!-- SISI KIRI: PANEL BRANDING COKELAT -->
            <div class="w-full md:w-5/12 bg-[#3D2C22] flex flex-col justify-between items-center p-8 text-white relative overflow-hidden min-h-[300px] md:min-h-screen">
                <div></div>
                
                <div class="flex flex-col items-center text-center z-10 my-auto">
                    <h1 class="text-3xl font-bold tracking-wide mb-2">Backery Marketplace</h1>
                    <p class="text-sm text-gray-300 mb-4">Panel Mitra & Admin</p>
                    <p class="text-xs text-gray-400 max-w-xs leading-relaxed">
                        Kelola mitra, payout, dan komisi platform dalam satu tempat.
                    </p>
                </div>

                <div class="text-xs text-gray-500 z-10 pb-4 md:pb-0">
                    &copy; 2026 Backery Marketplace
                </div>
            </div>

            <!-- SISI KANAN: FORM REGISTRASI -->
            <div class="w-full md:w-7/12 flex items-center justify-center p-8 lg:p-16">
                <div class="w-full max-w-md">

                    <div class="mb-6 text-center md:text-left">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Buat Akun Baru</h2>
                        <p class="text-sm text-gray-600">Masukkan detail data diri untuk mendaftarkan toko atau akun mitra.</p>
                    </div>

                    <!-- Session Status / Error -->
                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600 text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Nama Lengkap / Toko</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama Mitra / Toko Roti"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D2C22]">
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D2C22]">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D2C22]">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D2C22]">
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" class="w-full py-3 px-4 bg-[#3D2C22] hover:bg-[#2A1E17] text-white font-medium rounded-lg transition duration-200">
                                Daftar Sekarang
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center text-sm text-gray-600 pt-4">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-[#3D2C22] font-semibold hover:underline">
                                Masuk
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </body>
</html>