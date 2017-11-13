<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\View;
use Auth;
use App\Basket;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
      /*
       *  Set up locale and locale_prefix if other language is selected
       */
      if (in_array(Request::segment(1), config('app.alt_langs'))) {
           App::setLocale(Request::segment(1));
           config([ 'app.locale_prefix' => Request::segment(1) ]);
      }

      

      /**
       * Pass extra data to all views
       */
      //compose all the views....
      view()->composer('*', function ($view) 
      {
        if( Auth::check() )
        {
          $basket = Basket::where('user_id', Auth::user()->id);
          $view->with('cart', $basket );    
        }
        else
        {
          //$basket = new \stdClass();
          $basket = [];
          $view->with('cart', $basket );    
        }
          

          $action = app('request')->route()->getAction();
          $controller = class_basename($action['controller']);
          list($controller, $action) = explode('@', $controller);
          $view->with('controller', $controller);
      });
      //View::share('controller', 'xxx');

      

      
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
