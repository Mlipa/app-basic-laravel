<?php

namespace App\Providers;

use App\Models\Navegation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menuItems = Navegation::where('status', 'enabled')->get();
        view()->share('menuItems', $menuItems);
    }
}
