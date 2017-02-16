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
        //发布文件
        $this->publishFiles();

        //初始化菜单
        $this->initializeMenus();
    }


    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/config/menus.php' => config_path('menus.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/views/' => resource_path('views/'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/resources/' => public_path('app/'),
        ], 'config');
    }


    public function initializeMenus()
    {
        $menu_blade=config('menus.blade','*.menu');

        require __DIR__ . '/routes.php';

        view()->composer([$menu_blade],function($view){

            $menus=new MenusService();
            $view->with("menus",$menus->menusShow());
        });
    }
}
