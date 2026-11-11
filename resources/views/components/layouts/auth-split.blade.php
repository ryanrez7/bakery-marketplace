@props(['title' => 'Masuk'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-size: 20px">
<head>
    @include('partials.head')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">\
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-coklat" style="font-family: 'Poppins', sans-serif">
    <div class="fixed inset-0 grid overflow-y-auto lg:grid-cols-[30%_70%]">
        <div class="hidden flex-col items-center justify-center bg-coklat p-10 text-center text-white lg:flex">
            <div class="text-6xl">🧁</div>
            <h1 class="mt-6 text-xl font-semibold">Bakery Marketplace</h1>
            <p class="mt-1 text-sm text-krem-tua">Panel Mitra &amp; Admin</p>
            <p class="mt-6 max-w-xs text-xs text-krem-tua">Kelola mitra, payout, dan komisi platform dalam satu tempat.</p>
        </div>
        <div class="flex items-center justify-center p-6">
            <div class="w-full max-w-md">{{ $slot }}</div>
        </div>
    </div>
</body>
</html>