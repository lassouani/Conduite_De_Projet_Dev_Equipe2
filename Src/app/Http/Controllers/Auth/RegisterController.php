<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Notifications\RegisterUser;
use Illuminate\Auth\events\Registered;
use Illuminate\http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

use Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_token'=>str_replace('/', '',bcrypt(str_random(16))),
            //'github_id' => str_random(16),
            //'facebook_id' => str_random(16),
        ]);
    }





//------------------------------------------------1-------------------------------------------------------------
public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $user->notify(new RegisterUser());


       return redirect('/login')->with('success','Your account has been created you need to confirm. A confirmation link is sent to the email you provided');
    }

//----------------------------------------------2----------------------------------------------------------------


public function confirm($id, $token){
    //dd($id, $token);
    $user=User::Where('id',$id)->where('confirmation_token',$token)->first();

    if ($user){

        $user->update(['confirmation_token' => null]);
        $this->guard()->login($user);
        return redirect($this->redirectPath())->with('success','Your account has been confirmed, you\'re connected');

    } else {
        return redirect('/login')->with('error','Sorry, expired link');
    }
}

//-----------------------------------------------------------------------------------------------------------------------------------





}