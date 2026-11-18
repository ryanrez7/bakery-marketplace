<?php

use App\Modules\Outlet\Http\Controllers\ProfilTokoController;
use App\Support\Routing\PortalRoutes;
use Illuminate\Support\Facades\Route;

// PortalRoutes::outlet sudah memasang auth + verified + role:outlet dan prefix /outlet
PortalRoutes::outlet(function () {
    Route::get('/profil', [ProfilTokoController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilTokoController::class, 'update'])->name('profil.update');
});
