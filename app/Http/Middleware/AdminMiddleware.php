<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->is_admin) {
            return redirect()->route('home')->with('error', 'You do not have permission to access the admin dashboard.');
        }

        // If admin user is trying to access the home page, redirect to admin dashboard
        if ($request->is('/') && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
