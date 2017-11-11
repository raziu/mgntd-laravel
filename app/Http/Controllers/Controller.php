<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
      

      #$currentAction = \Route::currentRouteAction();
      #list($controller, $method) = explode('@', $currentAction);
      // $controller now is "App\Http\Controllers\FooBarController"
      #$controller = preg_replace('/.*\\\/', '', $controller);
      // $controller now is "FooBarController"
    }
}
