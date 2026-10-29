<?php

namespace App\Support\Routing;

use Closure;
use Illuminate\Support\Facades\Route;

final class PortalRoutes
{
    // portal admin: URL /admin/..., nama route admin.*
    public static function admin(Closure|string $routes): void
    {
        Route::middleware(['web', 'auth', 'verified', 'role:admin'])
            ->prefix('admin')
            ->name('admin.')
            ->group($routes);
    }

    // portal outlet (mitra): URL /outlet/..., nama route outlet.*
    public static function outlet(Closure|string $routes): void
    {
        Route::middleware(['web', 'auth', 'verified', 'role:outlet'])
            ->prefix('outlet')
            ->name('outlet.')
            ->group($routes);
    }
}