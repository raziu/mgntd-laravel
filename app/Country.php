<?php
/**
 * COUNTRY model
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
use Illuminate\Http\Request;

class Country extends Model
{
  /**
   * Create Eloquent Relationship
   * Eloquent will bind the models
   */
  public function basket()
  {
    return $this->belongsTo(Basket::class);
  }
}
