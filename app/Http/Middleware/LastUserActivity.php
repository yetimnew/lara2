<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Auth;
use Cache;
use Illuminate\Support\Facades\Auth as FacadesAuth;

// use Illuminate\Support\Facades\Cache as FacadesCache;

class LastUserActivity
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
        if(Auth::check()){
            $expiresAt = Carbon::now()->addMinutes(2);
            // dd( $expiresAt);
              Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}
