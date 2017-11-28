<?php
/**
 * SOCIAL AUTH FB Controller
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

class SocialAuthFacebookController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
    parent::__construct();
  }
  
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
  public function redirect()
  {
      return Socialite::driver('facebook')->redirect();
  }

  /**
   * Return a callback method from Facebook api.
   *
   * @return callback URL from Facebook
   */
  public function callback(SocialAccountService $service)
  {
     $user = $service->createOrGetUser(Socialite::driver('facebook')->user(), 'facebook');
     auth()->login($user);
     return redirect()->to('/');
  }
}
