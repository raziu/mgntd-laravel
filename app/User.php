<?php
/**
 * USERS model
 * 
 * PHP version 5
 * 
 * @category  Laravel
 * @author    Tomasz Razik <info@raziu.com>
 * @link      http://raziu.com/
 * @copyright 2017 Tomasz Razik
 */
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Create Eloquent Relationship
     * Eloquent will bind the models
     */
    public function baskets()
    {
      return $this->hasMany(Basket::class);
    }
}
