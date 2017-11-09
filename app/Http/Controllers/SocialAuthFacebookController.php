<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialAccountService;

class SocialAuthFacebookController extends Controller
{
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
