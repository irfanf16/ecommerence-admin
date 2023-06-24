<?php

namespace App\Http\Middleware;

use App\Traits\userPermissionCheck;
use Closure;
use Illuminate\Http\Request;

class Permissions
{
    use userPermissionCheck;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$permission=null)
    {

        if($permission !==null &&  !$this->userPermissionCheck($permission)){
            abort(403);
        }
        return $next($request);
    }
}
