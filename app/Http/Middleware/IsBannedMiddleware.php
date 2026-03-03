<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsBannedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->is_banned) {

            $reason = Auth::user()->reason;

            // dd(Auth::user());

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'You are banned from using this website. reason : ' . $reason);
        }

        return $next($request);
    }
}
