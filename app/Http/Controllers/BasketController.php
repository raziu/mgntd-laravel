<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Basket;

class BasketController extends Controller
{
    public function index()
    {
      //$user = Auth::user();
      return view('basket.index', compact('user'));
    }

    public function add()
    {
      return view('basket.add');
    }

    public function create(Request $request)
    {
      $basket = new Basket();
      $basket->user_id = Auth::id();
      $basket->pictures = $request->pictures;
      $basket->status = $request->status;
      $basket->quantity = $request->quantity;
      $basket->order_id = 0;
      $basket->type = $request->type;
      $basket->s3_id = $request->s3_id;
      $basket->product_type = $request->product_type;
      $basket->price = $request->price;
      $basket->border_color = $request->border_color;
      $basket->save();
      return redirect('/basket');
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
