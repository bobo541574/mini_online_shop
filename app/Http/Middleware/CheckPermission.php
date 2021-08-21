<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
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
        $requestUrlName = strtoslug($request->route()->getName(), false);

        if (Auth::check() && check_permission($requestUrlName)) {
            return $next($request);
        }

        return abort(401);
    }
}
