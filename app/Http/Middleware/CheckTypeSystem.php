<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Session;
use Closure;
use App\Models\User;

class CheckTypeSystem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
