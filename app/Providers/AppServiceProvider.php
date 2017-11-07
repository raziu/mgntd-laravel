<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      /*
       *  Set up locale and locale_prefix if other language is selected
       */
       if (in_array(Request::segment(1), config('app.alt_langs'))) {
           App::setLocale(Request::segment(1));
           config([ 'app.locale_prefix' => Request::segment(1) ]);
       }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
