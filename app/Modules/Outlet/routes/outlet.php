<?php

use App\Support\Routing\PortalRoutes;
use Illuminate\Support\Facades\Route;

PortalRoutes::outlet(function () {
    Route::get('/dashboard', function () {
        return view('outlet::dashboard');
    })->name('dashboard');
});