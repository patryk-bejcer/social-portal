<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');

    }

    //Google + Login

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        try{
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('auth/google');
        }

//        dd($user);

        $authUser = $this->createUser($user);

        Auth::login($authUser, true);
        return redirect()->route('wall');

    }

    public function createUser($user)
    {
        $authUser = User::where('remember_token', $user->id)->first();
//        dd($authUser);
        if($authUser){
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar_original,
            'sex' => 'm',
            'role_id' => 2,
        ]);
    }

    //Facebook Login

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        dd($user);

    }

    public function createFbUser($user)
    {
        $authUser = User::where('remember_token', $user->id)->first();
//        dd($authUser);
        if($authUser){
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar_original,
            'sex' => 'm',
            'role_id' => 2,
        ]);
    }


}
