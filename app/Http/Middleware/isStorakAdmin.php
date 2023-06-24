<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class isStorakAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // 2 IS THE user_role_id FOR VENDOR
        $user = $request->session()->get('user');
 
        if (!$user) {
            return response()->view('admin.pages.401');
        }

        // IF AUTH-USER IS NOT STORAK-ADMIN
        if (!$user->id == 1 || !$user->role_id == 1) {
            return response()->view('admin.pages.403');
        }
        
        return $next($request);
    }
    
}