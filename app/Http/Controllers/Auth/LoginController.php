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
        $authUser = User::where('google_id', $user->id)->first();
//        dd($authUser);
        if($authUser){
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'google_id' => $user->id,
            'email' => $user->email,
            'avatar' => $user->avatar_original,
            'sex' => 'm',
            'role_id' => 2,
        ]);
    }

    // Github Login

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }


    public function handleGithubCallback()
    {
        try{
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return redirect('auth/github');
        }

//        dd($user);

        $authUser = $this->createUserFromGithub($user);

        Auth::login($authUser, true);
        return redirect()->route('wall');

    }

    public function createUserFromGithub($user)
    {
        $authUser = User::where('github_id', $user->id)->first();

        if($authUser){
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'github_id' => $user->id,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'sex' => 'm',
            'role_id' => 2,
        ]);
    }

    //Facebook Login

//     public function redirectToFacebook()
//     {
//         return Socialite::driver('facebook')->redirect();
//     }

//     public function handleFacebookCallback()
//     {
//         $user = Socialite::driver('facebook')->user();
//         dd($user);

//     }

//     public function createFbUser($user)
//     {
//         $authUser = User::where('remember_token', $user->id)->first();
// //        dd($authUser);
//         if($authUser){
//             return $authUser;
//         }
//         return User::create([
//             'name' => $user->name,
//             'email' => $user->email,
//             'avatar' => $user->avatar_original,
//             'sex' => 'm',
//             'role_id' => 2,
//         ]);
//     }


}
