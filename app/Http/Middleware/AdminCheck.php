<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminCheck
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

            // Admin proceed
            if ( Auth::user()->isAdmin() ) {
                return $next($request);
            }
            else{
                return redirect('/');
            }

        }

        abort(404);  // for other user throw 404 error
    }
}
