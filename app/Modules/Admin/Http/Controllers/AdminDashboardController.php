<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

final class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin::dashboard');
    }
}