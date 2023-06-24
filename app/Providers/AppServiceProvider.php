<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;


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

        Paginator::useBootstrap();
        // can permission directive
        Blade::if('can', function ($module) {
            return true;
            $user_role_permissions = session()->get('user_role_permissions');
            if(isset($module)){
                foreach ($user_role_permissions as $permission){
                    if ($permission->slug==$module){
                        return true;
                    }
                }
                return false;
            }else{
                return false;
            }
        });

    }
}
