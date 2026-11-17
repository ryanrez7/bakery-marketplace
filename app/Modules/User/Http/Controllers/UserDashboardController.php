<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data produk (sesuaikan kolom dengan ERD: nama_produk, harga, gambar)
        $query = DB::table('produk')
            ->join('toko', 'produk.toko_id', '=', 'toko.id')
            ->select(
                'produk.id',
                'produk.nama_produk as name',
                'produk.harga as price',
                'produk.gambar as image',
                'toko.nama_toko as store_name'
            );

        // Fitur search kalau dicari lewat form search bar
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('produk.nama_produk', 'like', "%{$keyword}%")
                ->orWhere('toko.nama_toko', 'like', "%{$keyword}%");
        }

        $menus = $query->limit(4)->get();

        // Ubah format properti store agar cocok dengan blade ($menu->store->name)
        foreach ($menus as $menu) {
            $menu->store = (object) ['name' => $menu->store_name];
        }

        // 2. Ambil data toko untuk bagian bawah dashboard
        $stores = DB::table('toko')
            ->select('id', 'nama_toko as name')
            ->limit(8)
            ->get();

        // 3. Kirim kedua variabel ke view dashboard
        return view('user::dashboard', compact('menus', 'stores'));
    }
}
