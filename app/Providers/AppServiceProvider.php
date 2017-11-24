<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\View;
use Auth;
use App\Basket;
use Session;
use Config;

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
       * Set unique ID for users (not logged)
       */
      $sessionId = session()->getId();
      if(!session()->has('s3id') || ( session()->has('s3id') && session()->get('s3id') == "") )
      {
        $s3id = time().'-'.sprintf('%u', ip2long( $this->getIP() )).'-'.$sessionId;
        session()->put('s3id',$s3id);
      }

      /**
       * Pass extra data to all views
       */
      //compose all the views....
      view()->composer('*', function ($view) 
      {
        $cartItems = \App\Basket::where('status','saved')
        ->orderBy('id', 'desc')
        ->take(100)
        ->get()
        ;
        if( Auth::id() )
        {
          $cartItems->where('user_id', Auth::id() );
        }
        else
        {
          $cartItems->where('s3_id', session()->get('s3id') );
        }
        $view->with('cart', $cartItems );  
        //?not working in controller
        Config::set('cart', $cartItems);

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

    public function getIP()
    {
      if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
      {
        $forwarded_for = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
        return trim( $forwarded_for[ count( $forwarded_for ) - 1 ] );
      }
      else
      {
        return @$_SERVER['REMOTE_ADDR'];
      }
    }
}
