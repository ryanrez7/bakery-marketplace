@extends('admin::layouts.admin')

@section('title', 'Komisi Platform')

@section('content')
    <div class="flex flex-wrap items-start justify-between gap-3">
        <div>
            <h1 class="text-3xl font-bold">Komisi Platform</h1>
            <p class="text-sm">Pantau komisi yang diterima dari setiap transaksi</p>
        </div>
        <div class="flex gap-2">
            <button type="button" class="rounded-lg border border-[#473522] px-4 py-2 text-sm font-medium">Export</button>
            <button type="button" class="rounded-lg bg-[#473522] px-4 py-2 text-sm font-medium text-white">Atur Komisi</button>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4 xl:grid-cols-4">
        <div class="rounded-lg border border-gray-400 p-4">
            <p class="text-xs font-bold uppercase">Total Komisi</p>
            <p class="text-2xl font-bold">Rp {{ number_format($ringkasan['totalKomisi'], 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500">komisi yang sudah diterima</p>
        </div>
        <div class="rounded-lg border border-gray-400 p-4">
            <p class="text-xs font-bold uppercase">Persentase Komisi</p>
            <p class="text-2xl font-bold">{{ $ringkasan['persen'] }} %</p>
            <p class="text-xs text-gray-500">dari setiap transaksi</p>
        </div>
        <div class="rounded-lg border border-gray-400 p-4">
            <p class="text-xs font-bold uppercase">Transaksi Diproses</p>
            <p class="text-2xl font-bold">Rp {{ number_format($ringkasan['transaksi'], 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500">{{ $ringkasan['jumlahTransaksi'] }} transaksi</p>
        </div>
        <div class="rounded-lg border border-gray-400 p-4">
            <p class="text-xs font-bold uppercase">Komisi Menunggu</p>
            <p class="text-2xl font-bold">Rp {{ number_format($ringkasan['menunggu'], 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500">belum diterima</p>
        </div>
    </div>

    <div class="mt-6 rounded-lg border border-gray-400 p-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-bold">Riwayat Komisi</h2>

            <form method="GET" action="/admin/komisi" class="flex flex-wrap gap-2">
                <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari mitra..."
                       class="rounded-lg border border-gray-400 px-3 py-2 text-sm">
                <select name="status" class="rounded-lg border border-gray-400 px-3 py-2 text-sm">
                    <option value="">Semua status</option>
                    @foreach (['Diterima', 'Menunggu', 'Dibatalkan'] as $pilihan)
                        <option value="{{ $pilihan }}" @selected($status === $pilihan)>{{ $pilihan }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-lg bg-[#473522] px-4 py-2 text-sm font-medium text-white">Cari</button>
            </form>
        </div>

        <div class="mt-4 overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-[#f3eadb]">
                        <th class="rounded-l-lg px-4 py-3">No</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Mitra</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Transaksi</th>
                        <th class="px-4 py-3">Komisi</th>
                        <th class="rounded-r-lg px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayat as $baris)
                        @php
                            $warna = match ($baris['status']) {
                                'Diterima' => 'bg-green-200',
                                'Menunggu' => 'bg-yellow-200',
                                default => 'bg-red-200',
                            };
                        @endphp
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $baris['tanggal'] }}</td>
                            <td class="px-4 py-3">{{ $baris['mitra'] }}</td>
                            <td class="px-4 py-3">{{ $baris['kategori'] }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($baris['transaksi'], 0, ',', '.') }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($baris['komisi'], 0, ',', '.') }}</td>
                            <td class="px-4 py-3"><span class="rounded-full px-3 py-1 text-xs font-medium {{ $warna }}">{{ $baris['status'] }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-gray-500">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection