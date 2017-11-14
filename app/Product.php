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
    return __('products.'.$value);
  }
  public function getDescAttributeForTranslation( $value )
  {
    return __('products.'.$value.'_desc');
  }
  public function getIntroAttribute( $value )
  {
    return __('products.'.$value.'_intro');
  }

  public function setPriceAttribute($value)
  {
    $request = request();
    $currency = $request->session()->get('currency');
    if( $currency == 'PLN' )
    {
      $price = number_format($value,2);
    }
    else
    {
      $converter = 0.5;
      $price = number_format(ceil($value*$converter), 2);
    }
    return $this->attributes['price'] = $price;
  }

  public function setTypeAttribute( $value )
  {
    $res = [];
    //echo $value; exit;
    $types = explode('|', $value);
    if( count( $types ) )
    {
      foreach( $types as $t )
      {
        $res[] = $t;
      }
    }
    //echo "<pre>".print_r( $res, 1 )."</pre>"; exit;
    //return $res;
    return $this->attributes['type'] = $res;
  }

  public function setItemSizeAttribute( $value, $selected = false )
  {
    $res = [];
    $sizes = json_decode( $value );
    if( count( $sizes ) )
    {
      $res = $sizes;
      if( $selected )
      {
        $res = $sizes[ $selected ];
      }
    }
    return $this->attributes['item_size'] = $res;
  }

  public function setSetQuantityAttribute( $value, $selected = false )
  {
    $res = [];
    $arr = json_decode( $value );
    if( count( $arr ) )
    {
      $res = (array)$arr;
      //echo "<pre>".print_r( $res, 1 )."</pre>"; exit;
      if( $selected )
      {
        $res = $res[ $selected ];
      }
    }
    return $this->attributes['set_quantity'] = $res;
  }

}
