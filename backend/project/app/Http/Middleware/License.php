<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class License
{

    public function handle(Request $request, Closure $next)
    {
         return $next($request);
        if (file_exists(base_path('..') . '/project/license.txt')) {
            $license = file_get_contents(base_path('..') . '/project/license.txt');
            if ($license != "") {
                return $next($request);
            }
        }

        return redirect()->route('admin-activation-form')->with('error', 'Please activate your license first');

    }
}
