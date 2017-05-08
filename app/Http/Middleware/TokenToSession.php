<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Log;

class TokenToSession
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
        if ($request->path() == 'password/reset') {
            return $next($request);
        }
        $token = $request->input('token');
        if (!empty($token)) {
            try {
                $user = Auth::guard('api')->user();
                Auth::login($user);
                return redirect($request->url());
            } catch (Exception $e) {
                info(vsprintf('bad exception: %s'), $e->getMessage());
            }
        }
        return $next($request);
    }
}
