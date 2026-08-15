<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Queries\MenuQuery;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tahunAkademik', function () {
            $row = DB::table('mst_tahun')->where('is_active',1)->first();
            return $row;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Inject userMenus variables into all views (or specific views)
        View::composer(['main', 'home'], function ($view) {
            $userMenus = collect([]);
            if (Auth::check()) {
                $userMenus = MenuQuery::getMenusForUser(Auth::user());
            }
            $view->with('userMenus', $userMenus);
        });
    }
}
