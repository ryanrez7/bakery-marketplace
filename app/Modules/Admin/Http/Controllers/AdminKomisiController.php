<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminKomisiController extends Controller
{
    public function index(Request $request)
    {
        $persen = 10;

        // Data contoh. Nanti diganti data dari database.
        $semua = collect([
            ['tanggal' => '28 Okt 2026', 'mitra' => 'Bakery Rogojampi', 'kategori' => 'Bakery', 'transaksi' => 450000, 'status' => 'Diterima'],
            ['tanggal' => '27 Okt 2026', 'mitra' => 'Bakery Banyuwangi', 'kategori' => 'Bakery', 'transaksi' => 330000, 'status' => 'Diterima'],
            ['tanggal' => '26 Okt 2026', 'mitra' => 'Bakery Cluring', 'kategori' => 'Bakery', 'transaksi' => 280000, 'status' => 'Menunggu'],
            ['tanggal' => '24 Okt 2026', 'mitra' => 'Dapur Kita', 'kategori' => 'Restoran', 'transaksi' => 510000, 'status' => 'Diterima'],
            ['tanggal' => '21 Okt 2026', 'mitra' => 'Beverly Cafe', 'kategori' => 'Cafe', 'transaksi' => 300000, 'status' => 'Dibatalkan'],
        ])->map(function ($baris) use ($persen) {
            $baris['komisi'] = $baris['transaksi'] * $persen / 100;
            return $baris;
        });

        // Angka kartu dihitung dari semua data, bukan dari hasil filter.
        $ringkasan = [
            'totalKomisi' => $semua->where('status', 'Diterima')->sum('komisi'),
            'menunggu' => $semua->where('status', 'Menunggu')->sum('komisi'),
            'transaksi' => $semua->sum('transaksi'),
            'jumlahTransaksi' => $semua->count(),
            'persen' => $persen,
        ];

        // Filter dari kolom cari dan pilihan status.
        $cari = $request->query('cari');
        $status = $request->query('status');

        $riwayat = $semua
            ->when($cari, fn ($data) => $data->filter(
                fn ($baris) => str_contains(strtolower($baris['mitra']), strtolower($cari))
            ))
            ->when($status, fn ($data) => $data->where('status', $status))
            ->values();

        return view('admin::komisi', compact('ringkasan', 'riwayat', 'cari', 'status'));
    }
}