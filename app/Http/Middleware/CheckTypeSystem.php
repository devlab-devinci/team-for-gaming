<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
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
        $userId = Auth::id();
        $user = User::find($userId);

        foreach ($user->types as $type) {
            if($type->label === 'system') {
                return $next($request);
            }
        }
        Session::flash('auth', 'Vous n\'êtes pas autorisé à accéder à cette page');
        return redirect()->route('home');
    }
}
