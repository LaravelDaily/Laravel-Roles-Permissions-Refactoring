<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->hasRole('admin')) {
            return abort(403);
        }

        return $next($request);
    }
}