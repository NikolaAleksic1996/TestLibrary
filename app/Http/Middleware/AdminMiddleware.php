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
        if(Auth::check()) {
            // librarian role == 1
            // reader role == 0
            if(Auth::user()->role == 1) {
                return $next($request);
            } else {
                return redirect('/home')->with('message', 'Access Denied, you are not librarian!');
            }
        } else {
            return redirect('/login')->with('message', 'You must login to access online library!');
        }
        return $next($request);
    }
}
