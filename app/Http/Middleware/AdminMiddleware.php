<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redirect;
use Closure;
use Session;
class AdminMiddleware
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
        $AdminId = Session::get('AdminId');
        if($AdminId == null){
            return Redirect::to('/admin');
        }

        return $next($request);
    }
}
