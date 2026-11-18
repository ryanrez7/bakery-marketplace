<?php

namespace App\Modules\Outlet\Http\Controllers;

use App\Models\Bakery;
use App\Models\User;
use App\Modules\Outlet\Http\Requests\UpdateProfilTokoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class ProfilTokoController
{
    public function edit(Request $request): View
    {
        // toko diambil dari akun yang login, BUKAN dari URL atau input,
        // supaya mitra tidak bisa membuka toko milik orang lain
        $bakery = $request->user()->bakery;

        abort_unless($bakery && $request->user()->role === User::ROLE_MITRA_OWNER, 403);

        return view('outlet::profil', [
            'bakery'     => $bakery,
            'jenisUsaha' => Bakery::JENIS_USAHA,
            'kecamatan'  => Bakery::KECAMATAN,
            'daftarBank' => Bakery::BANK,
        ]);
    }

    public function update(UpdateProfilTokoRequest $request): RedirectResponse
    {
        // validated() hanya berisi kolom yang lolos aturan, jadi kolom seperti
        // status atau slug tidak bisa diubah lewat form ini
        $request->user()->bakery->update($request->validated());

        return redirect()
            ->route('outlet.profil.edit')
            ->with('status', 'Profil toko berhasil disimpan.');
    }
}
