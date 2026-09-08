<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{

    public function handle(Request $request, Closure $next, $data)
    {
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->id == 1) {
                return $next($request);
            }

            if (Auth::guard('admin')->user()->sectionCheck($data)) {
                return $next($request);
            } else {
                return redirect()->route('admin.dashboard')->with('error', "You don't have access to that section");
            }
        }
        return redirect()->route('admin.dashboard')->with('error', "You don't have access to that section");
    }
}
