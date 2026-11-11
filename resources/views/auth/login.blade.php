<x-layouts.auth-split title="Masuk">
    <h2 class="text-2xl font-semibold">Selamat Datang</h2>
    <p class="mt-1 text-sm text-coklat/70">Masuk untuk mengelola mitra, payout, dan komisi platform.</p>

    {{-- muncul setelah reset password berhasil --}}
    @if (session('status'))
        <div class="mt-6 rounded-lg border border-green-300 bg-green-50 px-3 py-2 text-sm text-green-700">
            Password berhasil diubah. Silakan masuk dengan password baru.
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-6 rounded-lg border border-red-300 bg-red-50 px-3 py-2 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" class="mt-6 space-y-4">
        @csrf

        <div>
            <label for="email" class="text-sm font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="nama@email.com"
                class="mt-1 w-full rounded-lg border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coklat {{ $errors->any() ? 'border-red-400' : 'border-krem-tua' }}">
        </div>

        <div>
            <label for="password" class="text-sm font-medium">Password</label>
            <div class="relative mt-1">
                <input id="password" type="password" name="password" required
                    placeholder="Masukkan password"
                    class="w-full rounded-lg border px-3 py-2 pr-16 text-sm focus:outline-none focus:ring-2 focus:ring-coklat {{ $errors->any() ? 'border-red-400' : 'border-krem-tua' }}">
                <button type="button" class="absolute inset-y-0 right-3 text-xs underline"
                    onclick="const i = document.getElementById('password'); i.type = i.type === 'password' ? 'text' : 'password'">
                    Lihat
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember"> Ingat saya
            </label>
            <a href="{{ route('password.request') }}" class="font-medium underline">Lupa password?</a>
        </div>

        <button type="submit" class="w-full rounded-lg bg-coklat py-2.5 text-sm font-medium text-white hover:bg-coklat-tua">
            Masuk
        </button>
    </form>
</x-layouts.auth-split>