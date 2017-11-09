<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialAccountService;

class SocialAuthInstagramController extends Controller
{
  /**
   * Create a redirect method to facebook api.
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
     //http://test.laravel/instagram/callback?
     //code=cfdd5e37bf08426c84c1c7087b4679d5
     //&state=eEr3vUQ8uRGawjjrAXEZwI2MM1fgzbwes3CvBCc2
     $user = $service->createOrGetUser(Socialite::driver('instagram')->user(), 'instagram');
     auth()->login($user);
     return redirect()->to('/');
  }
}
