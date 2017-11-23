<?php

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
