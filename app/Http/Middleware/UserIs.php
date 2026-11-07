<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIs
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $role = $request->user()->role;

        if (!in_array($role, $roles)) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);

    }
}
