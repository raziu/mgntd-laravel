<?php
/**
 * ORDER HISTORY model
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

class OrderHistory extends Model
{
  /**
    * The table associated with the model.
    *
    * @var string
    */
  protected $table = 'orders_history';
}
