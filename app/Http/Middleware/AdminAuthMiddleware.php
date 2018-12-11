<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
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
        //没有登录不允许登录后台
        if (!auth ('admin')->check ()){
            return redirect ()->route ('admin.login');
        }
        return $next($request);
    }
}
