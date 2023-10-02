<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\Role as ModelRole;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $role_id)
    {   
        $user = Auth::user();
        if($user->role_id == $role_id){
          return $next($request);
        }else{
            if($user->role_id == ModelRole::ROLE_ADMIN){
                return redirect()->route('dashboard.index');
            }else{
                return redirect()->route('dashboard.index');
            }
        }
        // return $next($request);
    }
}
