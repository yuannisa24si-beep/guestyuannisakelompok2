<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// 💡 PASTIKAN BARIS INI ADA
use Illuminate\Support\Facades\Auth; 

class CheckIsLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
		    return redirect()->route('auth.index')->withErrors('Silahkan login terlebih dahulu!');
		}

		return $next($request);
    }
}