<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Welcome') }} - {{ config('app.name', 'Laravel') }}</title>

        <!-- Tailwind CSS CDN v4 (Paling stabil dan bersih dari error compiler) -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="bg-white font-sans m-0 p-0">

        <!-- SISI UTAMA SPLIT SCREEN -->
        <div class="min-h-screen flex flex-col md:flex-row bg-white">

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
                    &copy; 2026 kelompok 5
                </div>
            </div>

            <!-- SISI KANAN: KONTEN / TOMBOL -->
            <div class="w-full md:w-7/12 flex items-center justify-center p-8 lg:p-16">
                <div class="w-full max-w-md text-center md:text-left">

                    <h2 class="text-3xl font-bold text-gray-900 mb-3">Selamat Datang di Bakery Marketplace</h2>
                    <p class="text-sm text-gray-600 mb-8 leading-relaxed">
                        Platform terpusat untuk mengelola toko roti, memantau pesanan mitra, dan transaksi komisi dengan mudah dan aman.
                    </p>

                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block w-full py-3 px-4 bg-[#3D2C22] hover:bg-[#2A1E17] text-white font-medium rounded-lg text-center transition duration-200">
                                    Masuk ke Dashboard
                                </a>
                            @else
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="{{ route('login') }}" class="flex-1 py-3 px-4 bg-[#3D2C22] hover:bg-[#2A1E17] text-white font-medium rounded-lg text-center transition duration-200">
                                        Masuk
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="flex-1 py-3 px-4 border border-[#3D2C22] text-[#3D2C22] hover:bg-gray-50 font-medium rounded-lg text-center transition duration-200">
                                            Daftar Mitra
                                        </a>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    @endif

                </div>
            </div>

        </div>

    </body>
</html>