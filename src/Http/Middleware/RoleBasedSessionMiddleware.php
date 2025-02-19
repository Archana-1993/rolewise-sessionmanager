<?php

namespace Itpathsolutions\Sessionmanager\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class RoleBasedSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->roles->first(); // Get the first assigned role
            if ($role) {
                if (!empty($role->session_lifetime)) {
                    Config::set('session.lifetime', $role->session_lifetime);
                }
            }
        }
        return $next($request);
    }
}
