<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Register\Controllers\RegisterController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;




class FacebookController extends Controller
{
    

 use AuthenticatesUsers;

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

          $user = User::create([

               'facebook_id' => $socialUser->getId(),
               'name' => $socialUser->getName().$socialUser->getNickname(),
               'email' => $socialUser->getEmail(),
               //'avatar' =>$socialUser->getAvatar(),
               //'github_id' => str_random(16),
               //'avatar' => "".$socialUser->getAvatar()."",
             ]);

          $this->guard()->login($user);
        
     return redirect()->to('/home')->with('success','Successfully signed in with Facebook.');

        // $user->token;
    }






}
