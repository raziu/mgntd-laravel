<?php
/**
 * SOCIAL ACCOUNTS model
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

class SocialAccounts extends Model
{
  protected $fillable = ['user_id', 'provider_user_id', 'provider'];
  
  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
