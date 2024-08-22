<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    if (Auth::check() && !Auth::user()->is_approved) {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('message', 'Akun Anda belum disetujui oleh admin.');
    }

    return $next($request);
}
}
