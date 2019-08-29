<?php

namespace App\Http\Middleware;

use Closure;

class Root
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
        if(auth()->user()->isRoot)
            return $next($request);

        return redirect('/');
    }
}
