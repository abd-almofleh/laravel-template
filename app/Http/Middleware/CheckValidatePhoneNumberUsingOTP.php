<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckValidatePhoneNumberUsingOTP
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $user = Auth::guard('customer_frontend')->user();
    if ($user) {
      if ($user->phone_verified_at == null) {
        return redirect()->route('customer.auth.account.validate-phone-number-view');
      }
    }

    return $next($request);
  }
}
