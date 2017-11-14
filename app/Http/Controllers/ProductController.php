<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;

class ProductController extends Controller
{
  public function index()
  {
    $products = \App\Product::where('active', 1)
    ->orderBy('id', 'desc')
    ->take(10)
    ->get();
    return view('product.index', compact('products'));
  }

  public function view($group, $type)
  {
    $product = \App\Product::where('active', 1)
    ->where('group', $group)
    ->first();

    //echo "<pre>".print_r( $product, 1 )."</pre>"; exit;
    $product_types = $product->setTypeAttribute( $product->type );
    $elements = $product->setSetQuantityAttribute( $product->set_quantity, $type );
    

    return view('product.view', compact('product', 'group', 'type', 'product_types', 'elements'));
  }

}
