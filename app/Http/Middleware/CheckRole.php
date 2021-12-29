<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.showLogin')->with('error', 'Silahkan Login Terlebih Dahulu');
        }

        $user = Auth::user();
        if ($user->role == $role) {
            return $next($request);
        }

        toast('Oops..Kamu tidak memiliki akses untuk halaman tersebut!', 'error');
        return redirect()->back();
    }
}