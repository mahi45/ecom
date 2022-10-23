<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Route;

class IsSystemAdmin
{
    protected $auth;
    protected $route;

    public function __construct(Guard $auth, Route $route)
    {
        $this->auth = $auth;
        $this->route = $route;
    }
    public function handle(Request $request, Closure $next)
    {
        if($this->auth->user()->is_system_admin != 1){
            return response('Access Denied, you are not customer', 401);
        }
        return $next($request);
    }
}
