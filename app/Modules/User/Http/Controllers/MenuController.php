<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $menus = Menu::with('toko')
            ->when($search, function ($query, $search) {
                return $query->where('nama_produk', 'like', "%{$search}%")
                             ->orWhereHas('toko', function ($q) use ($search) {
                                 $q->where('nama_toko', 'like', "%{$search}%");
                             });
            })
            ->paginate(10);

        return view('user::menus', compact('menus', 'search'));
    }
}