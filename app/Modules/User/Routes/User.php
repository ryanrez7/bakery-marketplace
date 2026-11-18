<?php

use App\Modules\User\Http\Controllers\UserDashboardController;
use App\Modules\User\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');

Route::get('/menus/{id}', function ($id) {
    return 'Detail Menu ID: '.$id;
})->name('menus.show');

Route::get('/stores', function () {
    return 'Halaman Semua Toko';
})->name('stores.index');

Route::get('/stores/{id}', function ($id) {
    return 'Detail Toko ID: '.$id;
})->name('stores.show');
