<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
  public function getImageAttribute( $value )
  {
    //echo 'app_locale = '.app()->getLocale(); exit;
    return $value;
  }
  public function getTitleAttributeForTranslation( $value )
  {
    return __('home.products_'.$value.'_header');
  }
  public function getDescAttributeForTranslation( $value )
  {
    return __('home.products_'.$value.'_text');
  }
  //public function getPriceAttribute()
  public function setPriceAttribute($value)
  {
    //todo switch to currency not locale
    //echo __LINE__.'<br/>';
    //echo "<pre>".print_r($this->price,1)."</pre>"; exit;

    //Request $request
    $request = request();
    $currency = $request->session()->get('currency');
    if( $currency == 'PLN' )
    {
      //$converter = 1;
      $price = $value;
    }
    else
    {
      $converter = 0.5;
      $price = number_format(ceil($value*$converter), 2);
    }
    return $this->attributes['price'] = $price;
  }
}
