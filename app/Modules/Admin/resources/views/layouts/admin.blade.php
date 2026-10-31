<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Bakery Marketplace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen bg-white text-[#473522]">

    <aside class="w-64 shrink-0 bg-[#473522] p-4 text-[#d9d9d9]">
        <div class="mb-8 text-lg font-medium">Bakery Marketplace
            <span class="block text-base">Admin</span>
        </div>

        @php
            $menu = [
                ['Dashboard', '/admin/dashboard', 'admin/dashboard*'],
                ['Data Mitra', '/admin/mitra', 'admin/mitra*'],
                ['Payout', '/admin/payout', 'admin/payout*'],
                ['Komisi Platform', '/admin/komisi', 'admin/komisi*'],
                ['Profil', '/admin/profile', 'admin/profile*'],
            ];
        @endphp

        <nav class="space-y-1">
            @foreach ($menu as [$label, $url, $pattern])
                <a href="{{ $url }}"
                   class="block rounded-lg px-4 py-3 {{ request()->is($pattern) ? 'bg-[#6b5330] text-white' : 'hover:bg-[#5a452d]' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        <button type="button"
            onclick="document.getElementById('modal-logout').showModal()"
            class="mt-6 w-full rounded-lg px-4 py-3 text-left hover:bg-[#5a452d]">
            Logout
        </button>
    </aside>

    <div class="min-w-0 flex-1">
        <header class="flex items-center justify-between p-4">
            <input type="search" placeholder="cari mitra, nama toko, atau lokasi"
                   class="w-80 rounded-lg border-0 bg-[#e4ccb3] px-4 py-2 text-sm placeholder:text-[#473522]/60">

            <div class="flex items-center gap-5">
                <button type="button" class="relative" aria-label="Notifikasi">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                    <span class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] text-white">3</span>
                </button>

                <details class="relative">
                    <summary class="flex cursor-pointer items-center gap-3" style="list-style:none">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#d9d9d9] font-medium">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <span class="leading-tight">
                            <span class="block text-sm font-medium">{{ auth()->user()->name }}</span>
                            <span class="block text-xs text-gray-500">{{ auth()->user()->role ?? 'admin' }}</span>
                        </span>
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </summary>

                    <div class="absolute right-0 z-10 mt-2 w-48 rounded-xl bg-[#e4ccb3] p-2 text-sm shadow-lg">
                        <a href="/admin/profile" class="block rounded-lg px-3 py-2 hover:bg-[#d9bd9a]">Cek Profile</a>
                        <a href="/admin/profile" class="block rounded-lg px-3 py-2 hover:bg-[#d9bd9a]">Keamanan</a>
                        <a href="#" class="block rounded-lg px-3 py-2 hover:bg-[#d9bd9a]">Pengaturan</a>
                        <a href="#" class="block rounded-lg px-3 py-2 hover:bg-[#d9bd9a]">Informasi</a>
                    </div>
                </details>
            </div>
        </header>

        <main class="p-6">@yield('content')</main>
    </div>
    <style>
    #modal-logout::backdrop {
        background: rgba(0, 0, 0, 0.55);
    }
</style>

<dialog id="modal-logout"
        style="margin:auto; width:100%; max-width:28rem; border:none; border-radius:1rem; padding:2rem; text-align:center; color:#473522;">
    <div style="margin:0 auto 1rem; width:64px; height:64px; border-radius:50%; background:#473522; color:#fff; display:flex; align-items:center; justify-content:center;">
        <svg width="28" height="28" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
        </svg>
    </div>

    <h2 style="font-size:1.25rem; font-weight:700;">Keluar Dari Akun?</h2>
    <p style="margin-top:0.5rem; font-size:0.875rem;">Apakah Anda yakin ingin keluar dari platform Bakery Marketplace</p>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:1.5rem; display:flex; gap:0.75rem;">
        @csrf
        <button type="button" onclick="this.closest('dialog').close()"
                style="flex:1; padding:0.75rem 1rem; border:none; border-radius:0.5rem; background:#d9d9d9; color:#473522; font-weight:500; cursor:pointer;">
            Batal
        </button>
        <button type="submit"
                style="flex:1; padding:0.75rem 1rem; border:none; border-radius:0.5rem; background:#473522; color:#fff; font-weight:500; cursor:pointer;">
            Ya, Keluar
        </button>
    </form>
</dialog>
    @stack('scripts')
</body>
</html>