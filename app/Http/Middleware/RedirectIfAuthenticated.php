<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Barryvdh\Debugbar\Facades\Debugbar;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure                 $next
   * @param string|null              ...$guards
   * @todo   fix redirecting to the right login page for the right route
   * @return mixed
   */
  public function handle(Request $request, Closure $next, ...$guards)
  {
    Debugbar::info($guards);
    $guards = empty($guards) ? [null] : $guards;
    foreach ($guards as $guard) {
      if (Auth::guard($guard)->check()) {
        if ($guard !== null && RouteServiceProvider::HOMES[$guard] !== null) {
          return redirect()->route(RouteServiceProvider::HOMES[$guard]);
        }

        redirect(RouteServiceProvider::HOME);
      }
    }

    return $next($request);
  }
}
