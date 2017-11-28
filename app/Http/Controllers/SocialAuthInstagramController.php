<?php
/**
 * SOCIAL AUTH INSTAGRAM Controller
 * 
 * PHP version 5
 * 
 * @category  Laravel
 * @author    Tomasz Razik <info@raziu.com>
 * @link      http://raziu.com/
 * @copyright 2017 Tomasz Razik
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialAccountService;

class SocialAuthInstagramController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
    parent::__construct();
  }
  
  /**
   * Create a redirect method to Instagram api.
   *
   * @return void
   */
  public function redirect()
  {
      //return Socialite::driver('instagram')->redirect();
      return Socialite::with('instagram')->redirect();
  }

  /**
   * Return a callback method from Instagram api.
   *
   * @return callback URL from Instagram
   */
  public function callback(SocialAccountService $service)
  {
     $user = $service->createOrGetUser(Socialite::driver('instagram')->user(), 'instagram');
     auth()->login($user);
     return redirect()->to('/');
  }
}
