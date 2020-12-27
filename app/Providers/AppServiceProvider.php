<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Category;

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
        view()->composer(
        ['admin.layouts.admin_menu',
          'admin.categories_index' ,
          'admin.categories_create',
          'admin.categories_update'
        ], function($view){
            $view->with('categories', Category::get()->toTree());
        });
    }
}
