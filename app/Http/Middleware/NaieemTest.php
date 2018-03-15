<?php

namespace App\Http\Middleware;

use Closure;

class NaieemTest
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
//        $key = "helloworld";
//        $token = array(
//            "iss" => "http://example.org",
//            "aud" => "http://example.com",
//            "iat" => date("h:i:sa"),
//            "nbf" => date("h:i:sa")
//        );

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
//        $jwt = JWT::encode($token, $key);
//        $token=$request->header('Authorization');
//        $decoded = JWT::decode($token, $key, array('HS256'));
//        return response()->json(['token'=>$decoded]);
        return $next($request);
    }
}
