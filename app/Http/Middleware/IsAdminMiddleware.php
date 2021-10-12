<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role_id !== User::ROLE_ADMIN) {
            return abort(403);
        }

        return $next($request);
    }
}