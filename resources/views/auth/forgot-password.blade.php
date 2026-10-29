<x-layouts.auth-split title="Lupa Password">
    @if (session('status'))
        {{-- tampilan "Cek Email Kamu" --}}
        <div class="text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-krem text-2xl">✉️</div>
            <h2 class="mt-4 text-xl font-semibold">Cek Email Kamu</h2>
            <p class="mt-2 text-sm text-coklat/70">
                Link reset password sudah dikirim. Cek kotak masuk atau folder spam.
            </p>
            <a href="{{ route('login') }}" class="mt-6 inline-block text-sm underline">Kembali ke login</a>
        </div>
    @else
        <a href="{{ route('login') }}" class="text-sm">← Kembali ke login</a>
        <h2 class="mt-4 text-2xl font-semibold">Lupa Password?</h2>
        <p class="mt-1 text-sm text-coklat/70">Masukkan email akunmu, kami kirim link untuk membuat password baru.</p>

        @error('email')
            <div class="mt-4 rounded-lg border border-red-300 bg-red-50 px-3 py-2 text-sm text-red-700">{{ $message }}</div>
        @enderror

        <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="text-sm font-medium">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="nama@email.com"
                    class="mt-1 w-full rounded-lg border border-krem-tua px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coklat">
            </div>
            <button type="submit" class="w-full rounded-lg bg-coklat py-2.5 text-sm font-medium text-white hover:bg-coklat-tua">
                Kirim Link Reset
            </button>
        </form>
    @endif
</x-layouts.auth-split>