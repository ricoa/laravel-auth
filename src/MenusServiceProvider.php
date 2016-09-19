<?php

namespace Ricoa\Auth;

use Ricoa\Auth\Services\MenusService;
use Illuminate\Support\ServiceProvider;

class MenusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //publish a config file
        $this->publishes([
            __DIR__ . '/config/menus.php' => config_path('menus.php'),
        ], 'config');

        //publish a blade file
        $this->publishes([
            __DIR__ . '/views/' => resource_path('views/'),
        ], 'config');

        //publish resources files
        $this->publishes([
            __DIR__ . '/resources/' => public_path('app/'),
        ], 'config');

        $menu_blade=config('menus.blade','*.menu');

        require __DIR__ . '/routes.php';

        view()->composer([$menu_blade],function($view){

            $menus=new MenusService();
            $view->with("menus",$menus->menusShow());
        });
    }
}
