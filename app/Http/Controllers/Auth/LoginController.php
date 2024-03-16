<?php

namespace App\Http\Controllers\Auth;

use App\Activities;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use File;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($servicve)
    {
        return Socialite::driver($servicve)->redirect();
    }

    public function handleProviderCallback($servicve)
    {

        if ($servicve == 'google') {
            $user = Socialite::driver('google')->stateless()->user();
            $picture = null;
        }
        else{
            $user = Socialite::driver($servicve)->user();
            $fileContents = file_get_contents($user->avatar_original);
            File::put(public_path() . '/upload/users/' . $user->getId() . ".jpg", $fileContents);
            $picture = 'upload/users/' . $user->getId() . ".jpg";
        }
       
        

        $findUser=User::where('email',$user->email)->first();
        if($findUser){
            Auth::login($findUser);
            return redirect('/');
        }
        else{
            $users=new User;
            $users->name=$user->name;
            $users->email=$user->email;
            $users->password=bcrypt(123456789);
            $users->image = $picture;
            $users->verified='1';
            $users->point='10';
            $users->save();

            // Save Activities
            // $activities =  new Activities();
            // $activities->user_id = $user->id;
            // $activities->activity = 'create account';
            // $activities->save();


            Auth::login($users);
            return redirect('/');
        }
    }

}
