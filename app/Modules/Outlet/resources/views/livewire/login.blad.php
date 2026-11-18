<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('components.layouts.outlet')] #[Title('Masuk Outlet')] class extends Component
{
    public string $email = '';
    public string $password = '';

    // logika login diisi di Tahap 4
    public function masuk(): void
    {
    }
}
?>

<div class="flex min-h-screen">

    {{-- Kiri: form login --}}
    <div class="flex w-full flex-col items-center justify-between bg-krem px-6 py-10 lg:w-1/2">
        <div class="flex w-full flex-1 flex-col items-center justify-center">

            <h1 class="text-2xl font-semibold">Bakery Marketplace</h1>
            <img src="{{ asset('images/logo.png') }}" alt="Logo Bakery Marketplace" class="mt-3 h-24 w-24 object-contain">
            <p class="mt-1 font-medium">Mitra / Outlet</p>

            <div class="mt-6 w-full max-w-sm rounded-3xl bg-cokelat p-8 text-white shadow-lg">
                <p class="font-medium">Selamat Datang 👋</p>
                <p class="text-sm">Silakan masuk ke akun outlet</p>

                {{-- pesan sukses, nanti dipakai setelah pendaftaran --}}
                @if (session('status'))
                    <div class="mt-4 rounded-lg bg-green-100 px-3 py-2 text-xs text-green-800">
                        {{ session('status') }}
                    </div>
                @endif

                <form wire:submit="masuk" class="mt-5 space-y-4" novalidate>
                    <div>
                        <label for="email" class="text-sm font-medium">Email</label>
                        <input id="email" type="email" wire:model="email" placeholder="email@outlet.com"
                               autocomplete="email"
                               class="mt-1 w-full rounded-lg bg-input px-4 py-2.5 text-sm text-cokelat placeholder-cokelat/60 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('email')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ lihat: false }">
                        <label for="password" class="text-sm font-medium">Password</label>
                        <div class="relative mt-1">
                            <input id="password" :type="lihat ? 'text' : 'password'" wire:model="password"
                                   autocomplete="current-password"
                                   class="w-full rounded-lg bg-input py-2.5 pl-4 pr-11 text-sm text-cokelat focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <button type="button" @click="lihat = !lihat"
                                    class="absolute inset-y-0 right-0 flex items-center px-3 text-cokelat"
                                    aria-label="Tampilkan atau sembunyikan password">
                                <svg x-show="!lihat" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg x-show="lihat" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.6 10.6a3 3 0 004.2 4.2M9.9 5.1A9.7 9.7 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-3.2 4M6.2 6.2C3.6 8 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.1-.9"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <a href="#" class="text-xs hover:underline">Lupa Password?</a>
                    </div>

                    <button type="submit" wire:loading.attr="disabled"
                            class="w-full rounded-md bg-blue-500 py-2 text-sm font-medium text-white transition hover:bg-blue-600 disabled:opacity-60">
                        <span wire:loading.remove wire:target="masuk">Masuk</span>
                        <span wire:loading wire:target="masuk">Memproses...</span>
                    </button>
                </form>

                <p class="mt-6 text-xs">
                    Belum punya akun?
                    {{-- tautan diganti ke route register di Tahap 5 --}}
                    <a href="#" class="ml-1 font-semibold hover:underline">Daftar sebagai Mitra</a>
                </p>
            </div>
        </div>

        <p class="mt-8 text-xs">{{ date('Y') }} Bakery Marketplace</p>
    </div>

    {{-- Kanan: foto, disembunyikan di layar kecil --}}
    <div class="hidden bg-cover bg-center lg:block lg:w-1/2"
         style="background-image: url('{{ asset('images/outlet-bg.jpg') }}')"></div>
</div>