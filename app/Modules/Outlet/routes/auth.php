<?php

use Illuminate\Support\Facades\Route;

// Halaman untuk tamu (belum login), makanya TIDAK memakai PortalRoutes::outlet(),
// karena PortalRoutes mewajibkan login. Prefix dan nama route sengaja disamakan: /outlet/... dan outlet.*
Route::middleware(['web', 'guest'])
    ->prefix('outlet')
    ->name('outlet.')
    ->group(function () {
        Route::livewire('/masuk', 'outlet::auth.login')->name('login');
    });