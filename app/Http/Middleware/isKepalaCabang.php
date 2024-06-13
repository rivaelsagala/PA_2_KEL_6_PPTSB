<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsKepalaCabang
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'Kepala Cabang') {
            return $next($request);
        }

        return redirect()->back()->with('error', 'You do not have access to this section.');
    }
}
