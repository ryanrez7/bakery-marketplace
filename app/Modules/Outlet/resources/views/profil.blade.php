@php
    $kelasInput = 'mt-1 w-full rounded-xl border border-krem bg-krem-muda/70 px-4 py-2.5 text-sm placeholder-cokelat/50 focus:border-cokelat focus:outline-none focus:ring-1 focus:ring-cokelat';
@endphp

<x-layouts.outlet>
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6">

        <div class="mb-6">
            <h1 class="text-2xl font-bold">Profil dan Lokasi Toko</h1>
            <p class="mt-1 text-sm">Data ini tampil ke pelanggan, dan rekening dipakai untuk pencairan dana.</p>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-xl bg-green-100 px-4 py-3 text-sm text-green-800">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-100 px-4 py-3 text-sm text-red-800">
                Data belum tersimpan. Periksa {{ $errors->count() }} kolom yang bertanda merah.
            </div>
        @endif

        <form method="POST" action="{{ route('outlet.profil.update') }}" class="space-y-6" novalidate>
            @csrf
            @method('PUT')

            {{-- PROFIL TOKO --}}
            <section class="rounded-3xl bg-krem-muda p-6">
                <h2 class="mb-4 text-lg font-semibold">Profil toko</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="nama" class="text-sm font-medium">Nama toko</label>
                        <input id="nama" name="nama" type="text" value="{{ old('nama', $bakery->nama) }}" class="{{ $kelasInput }}">
                        @error('nama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="jenis_usaha" class="text-sm font-medium">Jenis usaha</label>
                        <select id="jenis_usaha" name="jenis_usaha" class="{{ $kelasInput }}">
                            @foreach ($jenisUsaha as $jenis)
                                <option value="{{ $jenis }}" @selected(old('jenis_usaha', $bakery->jenis_usaha) === $jenis)>{{ $jenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis_usaha') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="deskripsi" class="text-sm font-medium">Deskripsi singkat</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3" maxlength="1000"
                                  placeholder="Ceritakan toko Anda: roti andalan, sejak kapan buka, dan sebagainya."
                                  class="{{ $kelasInput }}">{{ old('deskripsi', $bakery->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="whatsapp" class="text-sm font-medium">Nomor WhatsApp</label>
                        <input id="whatsapp" name="whatsapp" type="tel" value="{{ old('whatsapp', $bakery->whatsapp) }}" class="{{ $kelasInput }}">
                        @error('whatsapp') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            {{-- ALAMAT DAN LOKASI --}}
            <section class="rounded-3xl bg-krem-muda p-6"
                     x-data="{
                         lat: @js((string) old('latitude', $bakery->latitude)),
                         lng: @js((string) old('longitude', $bakery->longitude)),
                         tempel(teks) {
                             // format dari Google Maps: -8.2192, 114.3691
                             const bagian = teks.split(',').map(s => s.trim());
                             if (bagian.length === 2 && !isNaN(bagian[0]) && !isNaN(bagian[1])) {
                                 this.lat = bagian[0];
                                 this.lng = bagian[1];
                             }
                         },
                         get valid() {
                             return this.lat !== '' && this.lng !== '' && !isNaN(this.lat) && !isNaN(this.lng);
                         }
                     }">
                <h2 class="mb-4 text-lg font-semibold">Alamat dan lokasi</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="alamat" class="text-sm font-medium">Alamat lengkap</label>
                        <input id="alamat" name="alamat" type="text" value="{{ old('alamat', $bakery->alamat) }}"
                               placeholder="Jl. Contoh No. 123, Desa/Kelurahan" class="{{ $kelasInput }}">
                        @error('alamat') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="kecamatan" class="text-sm font-medium">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" class="{{ $kelasInput }}">
                            @foreach ($kecamatan as $item)
                                <option value="{{ $item }}" @selected(old('kecamatan', $bakery->kecamatan) === $item)>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="tempel" class="text-sm font-medium">Tempel koordinat dari Google Maps</label>
                        <input id="tempel" type="text" placeholder="-8.2192, 114.3691"
                               @input="tempel($event.target.value)" class="{{ $kelasInput }}">
                        <p class="mt-1 text-xs text-cokelat/70">
                            Buka Google Maps, klik kanan di lokasi toko, lalu klik angka koordinat paling atas untuk menyalinnya. Tempel di sini dan kedua kolom di bawah terisi otomatis.
                        </p>
                    </div>

                    <div>
                        <label for="latitude" class="text-sm font-medium">Latitude</label>
                        <input id="latitude" name="latitude" type="text" inputmode="decimal" x-model="lat" class="{{ $kelasInput }}">
                        @error('latitude') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="longitude" class="text-sm font-medium">Longitude</label>
                        <input id="longitude" name="longitude" type="text" inputmode="decimal" x-model="lng" class="{{ $kelasInput }}">
                        @error('longitude') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- pratinjau peta: muncul otomatis begitu koordinat valid --}}
                    <div class="sm:col-span-2">
                        <template x-if="valid">
                            <iframe :src="`https://maps.google.com/maps?q=${lat},${lng}&z=17&output=embed`"
                                    class="h-64 w-full rounded-xl border border-krem" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade" title="Pratinjau lokasi toko"></iframe>
                        </template>
                        <p x-show="!valid" class="rounded-xl border border-dashed border-cokelat/40 px-4 py-10 text-center text-sm text-cokelat/70">
                            Pratinjau peta muncul setelah koordinat diisi.
                        </p>
                    </div>
                </div>
            </section>

            {{-- REKENING --}}
            <section class="rounded-3xl bg-krem-muda p-6">
                <h2 class="mb-1 text-lg font-semibold">Rekening penampung</h2>
                <p class="mb-4 text-sm">Dana hasil penjualan dicairkan ke rekening ini. Pastikan nama sesuai pemilik usaha.</p>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div>
                        <label for="nama_bank" class="text-sm font-medium">Bank</label>
                        <select id="nama_bank" name="nama_bank" class="{{ $kelasInput }}">
                            <option value="">Pilih bank</option>
                            @foreach ($daftarBank as $bank)
                                <option value="{{ $bank }}" @selected(old('nama_bank', $bakery->nama_bank) === $bank)>{{ $bank }}</option>
                            @endforeach
                        </select>
                        @error('nama_bank') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="nomor_rekening" class="text-sm font-medium">Nomor rekening</label>
                        <input id="nomor_rekening" name="nomor_rekening" type="text" inputmode="numeric" autocomplete="off"
                               value="{{ old('nomor_rekening', $bakery->nomor_rekening) }}" class="{{ $kelasInput }}">
                        @error('nomor_rekening') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="atas_nama_rekening" class="text-sm font-medium">Nama pemilik rekening</label>
                        <input id="atas_nama_rekening" name="atas_nama_rekening" type="text" autocomplete="off"
                               value="{{ old('atas_nama_rekening', $bakery->atas_nama_rekening) }}" class="{{ $kelasInput }}">
                        @error('atas_nama_rekening') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <div class="flex justify-end">
                <button type="submit"
                        class="rounded-full bg-cokelat-tua px-8 py-3 font-semibold text-white transition hover:bg-cokelat">
                    Simpan perubahan
                </button>
            </div>
        </form>
    </div>
</x-layouts.outlet>
