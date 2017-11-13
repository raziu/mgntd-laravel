<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    //$this->middleware('auth');
    parent::__construct();
  }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHome()
    {
      //$products = App\Product::all();
      $products = \App\Product::where('active', 1)
      ->orderBy('id', 'desc')
      ->take(10)
      ->get();
      return view('home', compact('products'));
    }

    public function changeCurrency(Request $request)
    {
      if ($request->isMethod('post'))
      {
        //todo check if code is correct

        //Update session data
        $request->session()->put('currency', $request->currency);
        
        return response()->json(['status' => 'success', 'response' => $request->currency]); 
      }
    }

    /**
     * Newsletter ajax action
     */
    /*public function ajaxNewsletter(Illuminate\Http\Request $request)
    {
        if ($request->isMethod('post'))
        {    
            return response()->json(['response' => 'This is post method']); 
        }

        return response()->json(['response' => 'This is get method']);
    }*/
}
