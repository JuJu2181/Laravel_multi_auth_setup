<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //? to check for admin and normal users
            //if admin users and try to access any admin pages redirect to the login page
            //! No need to modify handler in vendor this method is correct
            if($request->routeIs('admin.*')){
                return route('admin.login');
            }
            return route('login');
        }
    }

}
