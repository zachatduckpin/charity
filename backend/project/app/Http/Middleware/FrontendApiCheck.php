<?php
namespace App\Http\Middleware;

use App\Models\Generalsetting;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendApiCheck
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        if($request->url()== route('admin.gs.site.settings') || $request->url() == route('admin.gs.update')){
            return $next($request);
        }
        if($request->url()== route('admin.dashboard')){
            return $next($request);
        }


        if($request->isMethod('post')){
            return $next($request);
        }
        if($request->isMethod('delete')){
            return $next($request);
        }
        if($request->isMethod('put')){
            return $next($request);
        }


        $status = false;
        $gs = Generalsetting::first();

        try {
            $response = Http::get($gs->frontend_url.'/api/connect');
            if ($response->status() == 200) {
                $status = true;
            } else {
                $status = false;
            }
        } catch (Exception $e) {
            $status = false;
        }

        if (!$status) {
            return redirect()->route('admin.gs.site.settings')->with('error', 'Your frontend url is not correct. Please check your frontend url.');
        }
        
    }
}
