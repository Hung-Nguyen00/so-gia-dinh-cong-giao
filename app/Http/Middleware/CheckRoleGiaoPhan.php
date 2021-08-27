<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleGiaoPhan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->quanTri->ten_quyen == 'admin' || Auth::user()->quanTri->ten_quyen == 'Giáo phận'){
            return $next($request);
        }
        return redirect()->route('home');
    }
}
