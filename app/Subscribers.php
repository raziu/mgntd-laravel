<?php
/**
 * SUBSCRIBERS model
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

class Subscribers extends Model 
{
  protected $table = 'subscribers';
  protected $fillable = array('email');
}