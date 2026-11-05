<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->age >= 18) {
            return $next($request);
        }

        return redirect()->route('panel')->with('error', '🔞 Acceso denegado al Casino: Debes ser mayor de 18 años.');
    }
}