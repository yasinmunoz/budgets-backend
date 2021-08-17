<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

//ex clase creada por nosotros
class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /* ex Entiendo que...
        Este metodo es porque en el AuthController, hemos metido el login y el register en excepciones del jwt
        con lo que, con este handle, le decimos como controlarlo
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken() -> authenticate();

        } catch (JWTException $e) {

            if ( $e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException ){
                /*return response()->json(['msg' =>'Invalid Token']);*/
                return json_encode(['msg' =>'Invalid Token']);

            } elseif ( $e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException ){
                return json_encode(['msg' =>'Expired Token']);

            } else {
                return json_encode(['msg' =>'Token Not Found']);
            }
        }
        return $next($request);
    }
}
