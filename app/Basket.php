<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
  /**
   * Create Eloquent Relationship
   * Eloquent will bind the models
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
