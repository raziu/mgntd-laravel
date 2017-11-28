<?php
/**
 * BASKET/CART Controller
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
use App\Basket;
use App\Country;
use App\Address;
use App\Delivery;
use App\DeliveryCountry;
use App\Payment;
use App\PaymentOption;
use App\Order;
use App\OrderHistory;
use Session;
use Config;
use DB;
use Hashids;

class BasketController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
    parent::__construct();
  }
  
  /**
   * Basket/cart items listing
   */
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

  /**
   * AJAX post action - add item to basket/cart
   */
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
    $basket = \App\Basket::where('status', 'saved')->get();
    if( Auth::id() )
    {
      $basket->where('user_id', Auth::id() );
    }
    else
    {
      $basket->where('s3_id', session()->get('s3id') );
    }
    /**
     * Get basket price 
     */
    $basketsArray = [];
    $price_cart = 0;
    foreach( $basket as $cartItem )
    {
      $basketsArray[] = $cartItem->id;
      $price_cart += ($cartItem->price * $cartItem->quantity);
    }

    //$cartItems = $basket->count();
    /**
     * Redirect to cart page, if no items found in cart
     */
    //echo count($basket); exit;
    if( !count($basket) )
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
        'payment_type' => 'required',
        'agreement_1' => 'required',
        //'agreement_2' => 'required',
      ],[
        //'fullname.required' => ' The first name field is required.',
        //'fullname.min' => ' The first name must be at least 5 characters.',
        //'fullname.max' => ' The first name may not be greater than 35 characters.',
      ]);

      /**
       * Save address data
       */
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
      /**
       * Save order data
       */
      $order = new Order();
      $order->user_id = (Auth::id() ? Auth::id() : 0);
      $order->s3_id = session()->get('s3id');
      /**
       * Get data from request
       */
      $order->address_id = $address->id;
      $order->payment_id = $request->payment_type;
      $order->delivery_id = $request->delivery_type;
      $order->price_cart = number_format($price_cart,2);
      $delivery = \App\Delivery::where('id',$request->delivery_type)->first();
      $order->price_shipping = $delivery->price;
      /**
       * // todo DISCOUNT MODULE
       */
      $order->price_discount = 0;
      $order->price_discount_type = '';
      $order->price_discount_desc = '';
      /**
       * Set other fields
       */
      $order->status = 1;
      $order->payment_session = (Auth::id() ? Auth::id() : session()->get('s3id')).'-'.time().'-'.$request->payment_type;
      $order->transaction_id = '';
      $order->order_hash = '';
      /**
       * Create pin for order view links
       */
      $digits = 4;
      $orderPin = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
      $order->order_pin = md5( $orderPin );
      $order->order_currency = session()->get('currency');
      /**
       * Add agreement checkboxes for not logged users
       * //todo
       */
      $order->agreement_1 = $request->agreement_1;
      $order->agreement_2 = (isset($request->agreement_2) ? $request->agreement_2 : 0);
      $order->comments = '';
      $order->archived = 0;
      /**
       * Set flag to add the order to cron
       */
      $order->to_cron = 1;
      /**
       * SAVE the order
       */
      $order->save();
      /**
       * Update order hash value
       */
      $orderSaved = Order::where('id', '=', $order->id)->first();
      $hashids = new Hashids\Hashids( config('app.name', 'MGNTD') );
      $orderSaved->order_hash = $hashids->encode( $orderSaved->id );
      $orderSaved->save();
      /**
       * Update baskets with order ID + change status from saved -> placed
       */
      DB::table('baskets')
      ->whereIn('id', $basketsArray)
      ->update(
        [
          'order_id' => $orderSaved->id,
          'status' => 'placed'
        ]
      );
      /**
       * Add order history entry
       */
      $orderHistory = new OrderHistory();
      $orderHistory->order_id = $order->id;
      $orderHistory->status = 1;
      $orderHistory->description = __('basket.order_status_1_desc');
      $orderHistory->updated_by = 'system';
      $orderHistory->created_at = time();
      $orderHistory->updated_at = time();
      $orderHistory->save();
      /**
       * Check payment method (for redirect)
       */
      $paymentMethod = Payment::where('id', '=', $order->payment_id)->first();
      return redirect()->route(app()->getLocale().'_basket_payment', [$paymentMethod->code, $orderSaved->order_hash]);
    }

    $iso = ( $request->old('country') != "" ? $request->old('country') : app()->getLocale() );
    /**
     * Get list of available countries
     */
    $countries = \App\Country::where('active', 1)
    ->orderBy('id', 'asc')
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
    return view('basket.shipping', compact('countries','deliveries','payments','cart'));
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

  /**
   * AJAX get payment sub options
   */
  public function payment_options( Request $request )
  {
    $parent = $request->input('parent');
    $options = \App\PaymentOption::getActiveOptions( $parent );
    return response()->json([
      'response' => $options, 
      'status' => 'success'
    ]);
  }

  public function payment( $paymentCode, $orderHash, Request $request )
  {
    $paymentOptions = false;
    $paymentMethod = Payment::where('code', '=', $paymentCode)->where('active', 1)->first();
    if( isset( $paymentMethod->subs ) )
    {
      $paymentOptions = PaymentOption::where('parent', '=', $paymentMethod->id)->where('active', 1)->get();
    }

    /**
     * Redirect if payment method not exists
     */
    if( !is_object($paymentMethod) )
    {
      return redirect()->route(app()->getLocale().'_basket');
    }

    $order = Order::where('order_hash', '=', $orderHash)->first();
    if( !is_object($order) )
    {
      return redirect()->route(app()->getLocale().'_home');
    }

    return view('basket.payment', compact('paymentCode', 'orderHash', 'paymentMethod', 'paymentOptions', 'order'));
  }
}
