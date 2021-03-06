<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            if(auth()->user()->isRoot)
                return redirect()->route('root');

            if(auth()->user()->isAdmin)
                return redirect()->route('admin');

            if(auth()->user()->isInstructor)
                return redirect()->route('instructor');

            if(auth()->user()->isStudent)
                return redirect()->route('student');

        }

        return $next($request);
    }
}
