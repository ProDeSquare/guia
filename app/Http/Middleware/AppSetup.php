<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use Illuminate\Http\Request;

class AppSetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Admin::all()->count()) {
            return $next($request);
        }

        return redirect('/app/setup');
    }
}
