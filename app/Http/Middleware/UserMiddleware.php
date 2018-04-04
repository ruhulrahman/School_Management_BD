<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Closure;
use Session;

class UserMiddleware
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
        $userId = Session::get('UserID');        
        $UserType = Session::get('UserType');
        $Power = Session::get('Power');

        if ($userId == Null) {
            return Redirect::to('/')->send();
        }

        return $next($request);
    }
}
