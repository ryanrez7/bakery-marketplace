<?php

use App\Modules\Admin\AdminServiceProvider;
use App\Modules\Outlet\OutletServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;

return [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    AdminServiceProvider::class,
    OutletServiceProvider::class,
];