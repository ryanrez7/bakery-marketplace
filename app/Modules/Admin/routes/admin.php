<?php

use App\Modules\Admin\Http\Controllers\AdminDashboardController;
use App\Support\Routing\PortalRoutes;
use Illuminate\Support\Facades\Route;

PortalRoutes::admin(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
});