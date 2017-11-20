<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
      //$this->includeJs();

      $this->middleware(function ($request, $next) {
        if (!$request->session()->has('currency')) 
        {
          $request->session()->put('currency', config('app.default_currency_code'));
        }
        if (!$request->session()->has('uploaded_files')) 
        {
          $request->session()->put('uploaded_files', []);
        }
        return $next($request);
      });

    }

    /**
    * Include js files
    */
  private function includeJs()
  {
    /*$currentAction = \Route::currentRouteAction();
    list($controller, $method) = explode('@', $currentAction);
    $controller = preg_replace('/.*\\\/', '', $controller);
    $controller = preg_replace('/Controller/', '', $controller);
    $js = '/js/' . kebab_case($controller) . '/' . kebab_case($method) . '.js';
    //echo $js; exit;
    if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . $js) )
    {
      return View::make($controller.".".$method)
      ->with("scripts", '<script src="'.$js.'">')
      ->with("styles", '')
      ;
    }*/
  }
}
