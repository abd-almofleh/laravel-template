<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;

class ApiLanguageSwitcher
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Closure                 $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    App::setLocale($request->header('Accept-Language', Config::get('app.locale')));
    return $next($request);
  }
}
