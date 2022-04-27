<?php

namespace App\Http\Middleware;

use App\Exceptions\WrongRoleHttpException;
use Closure;
use Illuminate\Http\Request;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        foreach ($role as $item) {
            if($request->user()->role->name == $item) {
                return $next($request);
            };
        };
        throw new WrongRoleHttpException();
    }
}
