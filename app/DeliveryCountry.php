<?php
/**
 * DELIVERY COUNTRY model
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
use DB;

class DeliveryCountry extends Model
{
  public static function getDeliveriesByCountry($iso = 'pl')
  {
    $deliveriesCommon = DB::table('deliveries_countries')
    ->where('country_id', 0)
    ->join('deliveries', 'deliveries.id', '=', 'deliveries_countries.delivery_id')
    ->leftJoin('countries', 'countries.id', '=', 'deliveries_countries.country_id')
    ->select(
      'deliveries_countries.*', 
      'deliveries.name as d_name',
      'deliveries.icon as d_icon',
      'deliveries.delivery_time as d_time',
      'deliveries.desc as d_desc',
      'deliveries.price as d_price',
      'countries.iso as c_iso',
      'countries.pl as c_pl',
      'countries.en as c_en',
      'countries.de as c_de'
    )
    ;
    $deliveries = DB::table('deliveries_countries')
    ->join('deliveries', 'deliveries.id', '=', 'deliveries_countries.delivery_id')
    ->join('countries', function ($join) use ($iso) {
      $join->on('countries.id', '=', 'deliveries_countries.country_id')
           ->where('countries.active', '=', 1)
           ->Where('countries.iso', '=', $iso)
           ;
    })
    ->select(
      'deliveries_countries.*', 
      'deliveries.name as d_name',
      'deliveries.icon as d_icon',
      'deliveries.delivery_time as d_time',
      'deliveries.desc as d_desc',
      'deliveries.price as d_price',
      'countries.iso as c_iso',
      'countries.pl as c_pl',
      'countries.en as c_en',
      'countries.de as c_de'
    )->orderBy('deliveries.price', 'ASC')
    ->union( $deliveriesCommon )
    ->get()
    ;
    //dd( $deliveries->toSql() );
    //echo "<pre>".print_r( $deliveries, 1 )."</pre>"; exit;
    //exit;

    $result = [];
    foreach( $deliveries as $d )
    {
      /*$iso = $d->c_iso;
      if( $d->c_iso == "" )
      {
        $iso = '*';
      }*/
      //$result[ $iso ][] = $d;
      $result[ $d->d_price ] = $d;
    }

    ksort($result);

    //echo "<pre>".print_r( $result, 1 )."</pre>"; exit;
    return $result;
    /*echo "<pre>".print_r( $result, 1 )."</pre>"; exit;
    if( isset( $result['*'] ) )
    {
      if( isset( $result[ $iso ] ) )
      {
        $sumArray = array_map(function ($a1, $b1) { return $a1 + $b1; }, $result['*'], $result[ $iso ]);
        echo "<pre>".print_r( $sumArray, 1 )."</pre>"; exit;
        return $result['*'] + $result[ $iso ];
      }
      else {
        return $result['*'];
      }
    }
    else {
      return [];
    }*/
  }
}
