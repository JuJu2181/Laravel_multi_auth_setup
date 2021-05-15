<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    //constructor
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    //for defining the guard 
    protected function guard(){
        return Auth::guard('admin');
    }

    //function for password broker
    protected function broker(){
        return Password::broker('admins');
    }

    //3 show reset form
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        
        return view('auth.passwords.reset-admin')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    //4 to reset the admin by sending post request
    //step 4 only need configuration of route guard and broker so its done> In step4 we just need to send post request to reset the password in db which is already done in reset of ResetsPasswords we just need to specify the guard and password broker for the admins and we are done 
}
