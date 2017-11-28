<?php
/**
 * HOME Controller
 * 
 * PHP version 5
 * 
 * @category  Laravel
 * @author    Tomasz Razik <info@raziu.com>
 * @link      http://raziu.com/
 * @copyright 2017 Tomasz Razik
 */
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
    $products = \App\Product::where('active', 1)
    ->orderBy('id', 'desc')
    ->take(10)
    ->get();
    return view('home', compact('products'));
  }

  /**
   * 
   */
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
}
