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

          if (!$user) 
          {
            if( $type == 'instagram' )
            {
              $data = [
                'email' => ( !empty($providerUser->getEmail()) ? $providerUser->getEmail() : $providerUser->getNickname().'@'.$type ),
                'name' => $providerUser->getNickname(),
                'password' => md5(rand(1,10000)),
              ];
            }

            if( $type == 'facebook' )
            {
              $data = [
                'email' => ( !empty($providerUser->getEmail()) ? $providerUser->getEmail() : $providerUser->getNickname().'@'.$type ),
                'name' => $providerUser->getName(),
                'password' => md5(rand(1,10000)),
              ];
            }

            $user = User::create($data);
          }
          $account->user()->associate($user);
          $account->save();
          return $user;
        }
    }
}