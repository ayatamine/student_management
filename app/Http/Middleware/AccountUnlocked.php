<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AccountUnlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  if (Auth::check()){
        if(Auth::user()->state == 0){
            return response()->view('auth.account_locked');
        }
        }
        return $next($request);
    }
}
