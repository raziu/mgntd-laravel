<?php
/**
 * PAYMENT OPTION model
 * 
 * PHP version 5
 * 
 * @category  Laravel
 * @author    Tomasz Razik <info@raziu.com>
 * @link      http://raziu.com/
 * @copyright 2017 Tomasz Razik
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentOption extends Model
{
  public static function getActiveOptions( $parent = 0 )
  {
    $options = self::where('active',1)->where('parent', $parent)
    ->orderBy('code', 'asc')
    ->get();

    $result = [];

    if( count( $options ) )
    {
      foreach( $options as $option )
      $result[] = [
        'code' => $option->code,
        'name' => $option->name,
        'icon' => $option->icon,
      ];
    }

    return $result;
  }
}
