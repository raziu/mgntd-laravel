<?php
/**
 * USER Controller
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
use Auth;
use Illuminate\Support\Facades\View;
use App\User;
//For custom log file
//use Monolog\Logger;
//use Monolog\Handler\StreamHandler;

class UserController extends Controller 
{
  public $_links;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(Request $request)
  {
    $this->middleware('auth');
    $this->_links[0] = new \stdClass;
    $this->_links[0]->name = 'profile.meta_title';
    $this->_links[0]->link = route('profile');
    $this->_links[1] = new \stdClass;
    $this->_links[1]->name = 'profile.meta_title_orders';
    $this->_links[1]->link = route('profile_orders');
    View::share('user_links', $this->_links);

    parent::__construct();
  }

  public function index()
  {
    $user = \App\User::where('id', Auth::id())->first();
    $addresses = \App\Address::where('user_id', Auth::id())->get();
    return view('user.profile', compact('user', 'addresses'));
  }

  public function orders()
  {
    $orders = \App\Order::where('user_id', Auth::id())->get();
    return view('user.orders', compact('orders'));
  }
}