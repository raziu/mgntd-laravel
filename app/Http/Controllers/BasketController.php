<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Basket;
use App\Country;
use App\Address;
use App\Delivery;
use App\DeliveryCountry;
use App\Payment;
use Session;
use Config;
use DB;

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

  /**
   * AJAX delete or update quantity action
   */
  public function update( Request $request )
  {
    $id = $request->input('id');
    $action = $request->input('action');
    $basket = \App\Basket::where('id',$id)->where('s3_id', session()->get('s3id'))->first();
    if( is_object($basket) )
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
    //\App\Basket::where('id',$id)->where('s3_id', session()->get('s3id'))->toSql()
    return response()->json([
      'response' => 'Error', 
      'status' => 'error'
    ]);
  }

  /**
   * Step shipping
   */
  public function shipping( Request $request )
  {
    /**
     * Get cart items of user
     */
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
    /**
     * Redirect to cart page, if no items found in cart
     */
    if( !count($cartItems) )
    {
      return redirect()->route(app()->getLocale().'_basket');
    }

    if ($request->isMethod('post'))
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
        'delivery_type' => 'required',
        'payment_type' => 'required'
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

    //echo 'old='.$request->old('country');

    $iso = ( $request->old('country') != "" ? $request->old('country') : app()->getLocale() );
    //echo 'iso='.$iso;
    //echo "<pre>".print_r( $request->country,1 )."</pre>"; exit;

    /**
     * Get list of available countries
     */
    $countries = \App\Country::where('active',1)
    ->orderBy('id', 'asc')
    ->take(100)
    ->get();
    /**
     * Get default list of available delivery types
     */
    $deliveries = \App\DeliveryCountry::getDeliveriesByCountry( $iso );
    /**
     * Get list of available payment methods
     */
    $payments = \App\Payment::where('active',1)
    ->orderBy('order', 'asc')
    ->get();
    /**
     * Return view
     */
    return view('basket.shipping', compact('countries','deliveries','payments'));
  }

  /**
   * NOT USED ANYMORE
   */
  public function validation(Request $request)
  {
    exit;
    $iso = ( isset( $request->country ) ? $request->country : app()->getLocale() );
    $deliveries = \App\DeliveryCountry::getDeliveriesByCountry( $iso );

    $this->validate($request,[
      'fullname' => 'required|min:5|max:70',
      'address' => 'required|min:5|max:150',
      'city' => 'required|min:5|max:30',
      'zip' => 'required|min:5|max:15',
      'email' => 'required|email|unique:users',
      'save_address' => 'sometimes',
      'address_name' => 'required_with:save_address|required_if:save_address,1|min:3|max:32',
      //'confirm_password' => 'required|min:3|max:20|same:password',
      'delivery_type' => 'required'
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

  /**
   * AJAX get delivery types of selected ISO code
   */
  public function country( Request $request )
  {
    $iso = $request->input('iso');
    $deliveries = \App\DeliveryCountry::getDeliveriesByCountry( $iso );
    if( count( $deliveries ) )
    {
      $json = [];
      foreach( $deliveries as $d )
      {
        $json[] = [
          'id' => $d->id,
          'icon' => $d->d_icon,
          'name' => __('basket.'.$d->d_name),
          'desc' => __('basket.'.$d->d_desc),
          'price' => $d->d_price,
          'time' => __('basket.'.$d->d_time)
        ];
      }
      return response()->json([
        'response' => $json, 
        'status' => 'success'
      ]);
    }
    else{
      return response()->json([
        'response' => 'Error', 
        'status' => 'error'
      ]);
    }
  }

  public function payment()
  {
    /*$basket = \App\Basket::where('status', 'saved');
    if( Auth::id() )
    {
      $basket->where('user_id', Auth::id() );
    }
    else
    {
      $basket->where('s3_id', session()->get('s3id') );
    }
    $cartItems = $basket->count();
    if( !count($cartItems) )
    {
      return redirect()->route(app()->getLocale().'_basket');
    }

    return view('basket.payment', compact(''));*/
  }
}
