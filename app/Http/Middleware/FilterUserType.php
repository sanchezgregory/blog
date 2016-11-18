<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class FilterUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if (Auth::user()->hastype($type)) {  // Auth es un facade y se llama desde la raiz asi \Auth. o se usa use Auth;
            return $next($request);
        } else {
            return abort(404);
        }

    }
}
