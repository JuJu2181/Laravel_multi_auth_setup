<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    //adding middleware via constructor
    function __construct()
    {
        //? users should not be logged in and it should use the admin guard
        $this->middleware('guest:admin')->except('logout');
    }

    //function to show login form
    public function showLoginForm(){
        return view('auth.admin-login');
    }

    //function to login based on form data
    public function login(Request $request){
        //validate the form data
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6|max:24'
        ]);
        //attempt to log in 
        //here we don't need to manually hash the password received from the form as the attempt function will itself hashes and checks the password in db.
        //also here the middleware itsel runs the trimstrings function to trim the unwanted whitespaces from the form
        //ignore this attempt error it is false alarm
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember))
        {
            //if success redirect to the intended location
            //using intended in redirect will redirect to the page the user is intending to go instead of dashboard in every case. It is like keeping next field in route to get the next route after login succeeds
            //here admin.dashboard is the default location so if there is no intended location it is redirected to the dashboard
            return redirect()->intended(route('admin.dashboard'));
        }
        //else redirect back to the login with the form data
        //?here back keeps the track of the previous page in this case it will be login form and we pass the email and remember token back if login fails
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    //function for logout functionality
    public function logout()
    {
        //this will log us out from admin
        Auth::guard('admin')->logout();

        return redirect('/');
    }
}
