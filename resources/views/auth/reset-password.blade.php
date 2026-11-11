<x-layouts.auth-split title="Buat Password Baru">
    <h2 class="text-2xl font-semibold">Buat Password Baru</h2>
    <p class="mt-1 text-sm text-coklat/70">Password baru harus berbeda dari password sebelumnya. Minimal 8 karakter.</p>

    @if ($errors->any())
        <div class="mt-4 rounded-lg border border-red-300 bg-red-50 px-3 py-2 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        <input type="hidden" name="email" value="{{ request('email') }}">

        <div>
            <label for="password" class="text-sm font-medium">Password Baru</label>
            <input id="password" type="password" name="password" required
                class="mt-1 w-full rounded-lg border border-krem-tua px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coklat">
        </div>

        <div>
            <label for="password_confirmation" class="text-sm font-medium">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="mt-1 w-full rounded-lg border border-krem-tua px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-coklat">
        </div>

        <button type="submit" class="w-full rounded-lg bg-coklat py-2.5 text-sm font-medium text-white hover:bg-coklat-tua">
            Simpan Password
        </button>
    </form>
</x-layouts.auth-split>