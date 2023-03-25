<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    /**
     * Handle an incoming request. auth('seller')->check() && auth('seller')->user()->status == 'approved'
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth('seller')->check()) {
            return $next($request);
        }
        auth()->guard('seller')->logout();
        return redirect()->route('seller.auth.login');
    }
}
