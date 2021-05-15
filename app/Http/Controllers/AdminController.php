<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //?here is by default it uses the user guard so it will allow all the users to login into admin dashboard
        //* so here we need to specify the admin guard  using :admin
        //Now even if we try going to the admin dashboard it will still redirect us to the user dashboard
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin-home');
    }
}
