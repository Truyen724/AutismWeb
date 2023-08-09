<?php

namespace App\Http\Middleware;
use Closure;


class Cors
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
           return $next($request)
               ->header('Access-Control-Allow-Origin', '*')
               ->header('Access-Control-Allow-Methods', '*')
               ->header('Access-Control-Allow-Credentials', 'true')
               ->header('Access-Control-Allow-Headers', 'X-CSRF-Token');
    }
}
