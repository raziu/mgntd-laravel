<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Basket;
use App\Country;
use App\Address;
use Session;
use Config;

class BasketController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
    parent::__construct();
  }
  
  public function index()
  {
    //$user = Auth::user();
    $items = \App\Basket::where('status','saved')
    ->orderBy('id', 'desc')
    ->take(100)
    ->get()
    ;
    if( Auth::id() )
    {
      $items->where('user_id', Auth::id() );
    }
    else
    {
      $items->where('s3id', session()->get('s3id') );
    }
    //Comment out get() before use! ;)
    //dd($items->toSql(), $items->getBindings()); 
    return view('basket.index', compact('user', 'items'));
  }

  public function create(Request $request)
  {
    if($request->isMethod('post')) 
    {
      $basket = new Basket();
      $basket->user_id = (Auth::id() ? Auth::id() : 0);
      $basket->pictures = base64_encode(json_encode($request->pictures));
      $basket->status = 'saved';
      $basket->quantity = 1;
      $basket->order_id = 0;
      $basket->type = $request->product_type;
      $basket->s3_id = session()->get('s3id');
      $basket->product_type = $request->group;
      $basket->price = $request->product_price;
      $basket->border_color = $request->border;
      $basket->save();
    }
    return response()->json([
      'response' => '', 
      'status' => 'success'
    ]);
  }

  /*public function edit( Basket $basket )
  {
    if( Auth::check() && Auth::user()->id == $basket->user_id )
    {
      return view('basket.edit', compact('basket'));
    }
    else
    {
      return redirect('/basket');
    }
  }*/

  public function update( Request $request )
  {
    $id = $request->input('id');
    $action = $request->input('action');
    $basket = \App\Basket::where('id',$id)->where('s3_id', session()->get('s3id'))->first();
    if( $basket != null )
    {
      if( $action == 'delete' )
      { 
        if ( $request->ajax() ) 
        {
          $basket->delete();
          return response()->json([
            'response' => route('basket'), 
            'status' => 'success'
          ]);
        }
      }
      else
      {
        $quantity = (int)$request->input('quantity');
        $basket->quantity = $quantity;
        $basket->save();
        return response()->json([
          'response' => route('basket'), 
          'status' => 'success'
        ]);
      }
    }
    return response()->json([
      'response' => route('basket'), 
      'status' => 'error'
    ]);
  }

  public function shipping()
  {
    //$cart = Config::get('cart');
    //if( !count($cart) )
    //{
      //echo count($cart); exit;
      //return redirect()->route(app()->getLocale().'_basket');
    //}

    $basket = \App\Basket::where('status', 'saved');
    if( Auth::id() )
    {
      $basket->where('user_id', Auth::id() );
    }
    else
    {
      $basket->where('s3_id', session()->get('s3id') );
    }
    $cartItems = $basket->count();
    //echo $cartItems; exit;
    if( !count($cartItems) )
    {
      //echo count($cart); exit;
      return redirect()->route(app()->getLocale().'_basket');
    }

    $countries = \App\Country::where('active',1)
    ->orderBy('id', 'asc')
    ->take(100)
    ->get();

    return view('basket.shipping', compact('countries'));
  }

  public function validation(Request $request)
  {
    $this->validate($request,[
      'fullname' => 'required|min:5|max:70',
      'address' => 'required|min:5|max:150',
      'city' => 'required|min:5|max:30',
      'zip' => 'required|min:5|max:15',
      'email' => 'required|email|unique:users',
      'save_address' => 'sometimes',
      'address_name' => 'required_with:save_address|required_if:save_address,1|min:3|max:32',
      //'confirm_password' => 'required|min:3|max:20|same:password',
    ],[
      //'fullname.required' => ' The first name field is required.',
      //'fullname.min' => ' The first name must be at least 5 characters.',
      //'fullname.max' => ' The first name may not be greater than 35 characters.',
      
    ]);
    //Save address data
    $address = new Address();
    $address->user_id = (Auth::id() ? Auth::id() : 0);
    $address->s3_id = session()->get('s3id');
    $address->fullname = $request->fullname;
    $address->address = $request->address;
    $address->city = $request->city;
    $address->zip = $request->zip;
    $address->country = $request->country;
    $address->email = $request->email;
    $address->address_name = ($request->address_name) ? $request->address_name : '---';
    $address->save();

    return redirect()->route(app()->getLocale().'_basket_payment');
  }

  public function payment()
  {
    return view('basket.payment', compact(''));
  }
}
