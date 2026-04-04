<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';
    public const ADMIN_HOME = '/admin/dashboard';
    public const HOME_ROUTE = 'home';
    public const ADMIN_HOME_ROUTE = 'admin.dashboard';

    public function boot(): void
    {
        //
    }
}
