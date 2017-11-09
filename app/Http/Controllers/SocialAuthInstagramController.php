<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialAccountService;

class SocialAuthInstagramController extends Controller
{
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
