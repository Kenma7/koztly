<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        foreach ($roles as $role) {
            if (Auth::check() && Auth::user()->role == $role) {
                return $next($request);
            }
        }

        Auth::logout();
        return redirect('/login')->with('error', 'You do not have access to this page.');
    }
}
