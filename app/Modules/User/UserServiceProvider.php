<?php

namespace App\Modules\User;

use App\Modules\ModuleServiceProvider;

final class UserServiceProvider extends ModuleServiceProvider
{
    protected function moduleAlias(): string
    {
        return 'user';
    }
}
