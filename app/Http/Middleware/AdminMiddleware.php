<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
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
        if (auth()->user() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect or abort the request if the user doesn't have the 'admin' role
        return redirect()->route('dashboard')->with('error', 'Unauthorized. You must be an admin.');
    }

}
