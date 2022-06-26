<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);
        if( Auth::check() )
        {

            // User proceed
            if ( Auth::user()->isUser() ) {
                return $next($request);
            }

            // Admin can proceed with request
            else if ( Auth::user()->isAdmin() ) {
                return $next($request);
            }

            //Not a user, back to landing
            else{
                return redirect('/');
            }

        }

        abort(404);  // for other user throw 404 error
    }
}
