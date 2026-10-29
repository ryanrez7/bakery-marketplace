<?php

namespace App\Modules\Outlet;

use App\Modules\ModuleServiceProvider;

final class OutletServiceProvider extends ModuleServiceProvider
{
    protected function moduleAlias(): string
    {
        return 'outlet';
    }
}