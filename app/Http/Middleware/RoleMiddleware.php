<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $userRole = auth()->user()->role ?? null;

        if (($role == 'staff' && $userRole === User::ROLE_STAFF) || ($role == 'admin' && $userRole === User::ROLE_ADMIN)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Access denied.');
    }
}
