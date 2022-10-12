<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;


        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {

                switch ($guard) {
                    case ($guard === 'manager'):
                        return redirect(RouteServiceProvider::MANAGER);
                        break;
                    case ($guard === 'caretaker'):
                        return redirect(RouteServiceProvider::CARETAKER);
                        break;
                    case ($guard === 'web'):
                        return redirect(RouteServiceProvider::HOME);
                        break;
                    case ($guard === 'tenant'):
                        return redirect(RouteServiceProvider::TENANT);
                        break;
                    case ($guard === 'landlord'):
                        return redirect(RouteServiceProvider::LANDLORD);
                        break;
                    default:
                        return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
