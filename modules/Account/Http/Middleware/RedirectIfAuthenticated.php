<?php

namespace Modules\Account\Http\Middleware;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /* @return RedirectResponse|\Closure */
    public function handle(Request $request, \Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->route('account.dashboard');
            }
        }

        return $next($request);
    }
}
