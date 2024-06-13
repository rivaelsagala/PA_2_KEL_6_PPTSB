<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsKepalaSektor
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'Kepala Sektor') {
            return $next($request);
        }

        return redirect()->back()->with('error', 'You do not have access to this section.');
    }
}
