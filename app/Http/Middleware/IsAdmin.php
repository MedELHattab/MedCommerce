<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        // Check if the user is authenticated and has role admin
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // If not an admin, redirect or return an unauthorized response
        // For example:
        return abort(403, 'Unauthorized action.');
    }
}