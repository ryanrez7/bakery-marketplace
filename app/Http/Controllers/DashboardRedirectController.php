<?php

namespace App\Http\Controllers;

use App\Modules\User\Http\Controllers\UserDashboardController;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardRedirectController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        $user = $request->user();

        if ($user?->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user?->isOutlet()) {
            return redirect()->route('outlet.dashboard');
        }

        // konsumen biasa: halaman dashboard bawaan (bagian teman yang memegang konsumen)
        return (new UserDashboardController)->index($request);
    }
}
