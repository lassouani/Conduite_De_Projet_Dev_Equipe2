<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Notifications\RegisterUser;

use Socialite;




class FacebookController extends Controller
{
    

/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
       try{
           $socialUser = Socialite::driver('facebook')->user();
        }catch (\Exception $e){
             return redirect('/');
        }

    $user = User::where('facebook_id',$socialUser->getId())->first();

        if(!$user)

            User::create([

               'facebook_id' => $socialUser->getId(),
               'name' => $socialUser->getName(),
               'email' => $socialUser->getEmail(),
             ]);

         //$this->guard()->login($user);
        auth()->login($user);

      
         return redirect()->to('/home')->with('success','Successfully signed in with Facebook.');

        // $user->token;
    }


}
