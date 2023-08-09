<?php

namespace App\Http\Middleware;
use Closure;

use Illuminate\Support\Facades\App;
class CheckLanguage
{
    public function handle($request, Closure $next)
    {
          if($request->has('X-CLIENT-REQUEST'))
          {
            $lang = $request->header('x-client-language');
            App::setLocale($lang);
          }
          return $next($request);
    }
}
