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
        $this->loadViewsFrom(__DIR__.'/views', 'ricoa');

        //发布文件
        $this->publishFiles();

        //初始化菜单
        $this->initializeMenus();
    }


    public function publishFiles()
    {
        //配置文件
        $this->publishes([
            __DIR__ . '/config/menus.php' => config_path('menus.php'),
        ], 'config');

        //视图文件
        $this->publishes([
            __DIR__ . '/views/layouts' => resource_path('views/layouts'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/views/permissions' => resource_path('views/permissions'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/views/role_user' => resource_path('views/role_user'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/views/roles' => resource_path('views/roles'),
        ], 'config');

        //js
        $this->publishes([
            __DIR__ . '/resources/' => public_path('app/'),
        ], 'config');

        //migration
        $this->publishSeeder();
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


    public function publishSeeder()
    {
        $migrationFile = base_path("/database/seeds")."/RicoaUsersSeeder.php";

        $output = view()->make('ricoa::generators.seeder')->render();

        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }

        return false;
    }
}
