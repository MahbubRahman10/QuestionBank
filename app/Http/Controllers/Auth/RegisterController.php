<?php

namespace App\Http\Controllers\Auth;

use App\Activities;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Mail\EmailVerification;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;


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

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        // dd($request);
        // User Register validation
        $validator = $this->validator($request->all());
        if ($validator->fails()) 
        {
            $this->throwValidationException($request, $validator);
        }
       
        // I don't know what I said in the last line! Weird!
        DB::beginTransaction();
        try
        {
            $user = $this->create($request->all());
            // After creating the user send an email with the random token generated in the create method above
            $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->name]));
            Mail::to($user->email)->send($email);
           
            DB::commit();


            // Save Activities
            $activities =  new Activities();
            $activities->user_id = $user->id;
            $activities->activity = 'create account on qbank';
            $activities->save();


            return redirect()->to("/email-confirm");
        }
        catch(Exception $e)
        {
            DB::rollback(); 
            return back();
        }
    }

    public function checkemailphone(Request $request)
    {
        
        $email = User::where('email','=',$request->email)->first();
        if ($email != null) {
            return Response()->json(401);
        }

        $mobile = User::where('mobile','=',$request->mobile)->first();
        if ($mobile != null) {
            return Response()->json(402);
        }        

    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => ucfirst($data['name']),
            'mobile' =>$data['mobile'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(10),
        ]);
    }

    // Verified the User
    public function verify($token)
    {
        $user = User::where('email_token',$token)->first();
        $user->point = '10';
        $user->save();
        // The verified method has been added to the user model and chained here
        // for better readability
        User::where('email_token',$token)->firstOrFail()->verified();

        // Auth::login($user);
        // return redirect('/'); 


        return redirect('login')->with('successactive','Your account has been activated.'); 
    }
}
