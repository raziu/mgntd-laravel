<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Basket;

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
      return view('basket.index', compact('user'));
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
        $basket->s3_id = 0;
        $basket->product_type = $request->group;
        $basket->price = 0;
        $basket->border_color = $request->border;
        $basket->save();
      }
      return response()->json([
        'response' => '', 
        'status' => 'success'
      ]);
    }

    public function edit( Basket $basket )
    {
      if( Auth::check() && Auth::user()->id == $basket->user_id )
      {
        return view('basket.edit', compact('basket'));
      }
      else
      {
        return redirect('/basket');
      }
    }

    public function update( Request $request, Basket $basket )
    {
      if( isset( $_POST['delete'] ) )
      {
        $basket->delete();
        return redirect('/basket');
      }
      else
      {
        $basket->pictures = $request->pictures;
        $basket->status = $request->status;
        $basket->quantity = $request->quantity;
        $basket->order_id = $request->order_id;
        $basket->type = $request->type;
        $basket->s3_id = $request->s3_id;
        $basket->product_type = $request->product_type;
        $basket->price = $request->price;
        $basket->border_color = $request->border_color;
        $basket->save();
        return redirect('/basket');
      }
    }
}
