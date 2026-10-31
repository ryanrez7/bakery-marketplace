<?php

namespace App\Modules\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'admin');

        Route::middleware(['web', 'auth', 'role:admin'])
            ->prefix('admin')
            ->name('admin.')
            ->group(__DIR__.'/routes/admin.php');
    }
}