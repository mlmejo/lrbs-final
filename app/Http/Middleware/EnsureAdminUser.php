<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminUser
{
    /**
     * Ensure that there is an administrator account in the application.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->exists()) {
            return redirect()->route('login');
        };

        return $next($request);
    }
}
