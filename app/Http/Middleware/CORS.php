<?php

namespace App\Http\Middleware;

use Closure;
use http\Env\Request;

class CORS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        header('Acess-Control-Allow-Origin: *');
        header('Acess-Control-Allow-Origin: Content-type, X-Auth-Token, Authorization, Origin');

        return $next($request);
    }
}
