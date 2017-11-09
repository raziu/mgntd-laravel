<?php

namespace App\Services;
use App\SocialAccounts;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $type = 'instagram')
    {
        $account = SocialAccounts::whereProvider( $type )
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) 
        {
          return $account->user;
        } 
        else 
        {
          $account = new SocialAccounts([
              'provider_user_id' => $providerUser->getId(),
              'provider' => $type
          ]);
          $user = User::whereEmail($providerUser->getEmail())->first();

          //echo "<pre>".print_r( $providerUser, 1 )."</pre>"; exit;  
          /*[accessTokenResponseBody] => Array
        (
            [access_token] => 10573494.805910e.20cd74c3510b4c1fa7331e49a6273d98
            [user] => Array
                (
                    [id] => 10573494
                    [username] => raziu
                    [profile_picture] => https://scontent.cdninstagram.com/t51.2885-19/928767_1558162144472568_1729175738_a.jpg
                    [full_name] => TR
                    [bio] => Poland - Świdnica
                    [website] => 
                    [is_business] => 
                )

        )

    [token] => 
    [refreshToken] => 
    [expiresIn] => 
    [id] => 10573494
    [nickname] => raziu
    [name] => TR
    [email] => 
    [avatar] => https://scontent.cdninstagram.com/t51.2885-19/928767_1558162144472568_1729175738_a.jpg
    [user] => Array
        (
            [id] => 10573494
            [username] => raziu
            [profile_picture] => https://scontent.cdninstagram.com/t51.2885-19/928767_1558162144472568_1729175738_a.jpg
            [full_name] => TR
            [bio] => Poland - Świdnica
            [website] => 
            [is_business] => 
            [counts] => Array
                (
                    [media] => 55
                    [follows] => 60
                    [followed_by] => 27*/

          if (!$user) 
          {
              $user = User::create([
                  'email' => ( !empty($providerUser->getEmail()) ? $providerUser->getEmail() : $providerUser->getNickname().'@instagram' ),
                  'name' => $providerUser->getNickname(),
                  'password' => md5(rand(1,10000)),
              ]);
          }
          $account->user()->associate($user);
          $account->save();
          return $user;
        }
    }
}