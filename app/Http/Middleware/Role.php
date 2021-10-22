<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // Handle requests from users with insuffient access level.
    public function handle($request, Closure $next, $level)
    {   
        if ($level < $request->user()->access_level) {
            abort(403);
        }

        return $next($request);
    }
}
