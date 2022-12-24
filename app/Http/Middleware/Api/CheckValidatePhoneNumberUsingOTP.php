<?php

namespace App\Http\Middleware\Api;

use App\Exceptions\PhoneNumberNotVerifiedException;
use App\Http\Controllers\Api\v1\AuthController;
use App\Services\Security\SecurityService;
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
    $user = Auth::guard(AuthController::$guard)->user();
    if ($user) {
      if ($user->phone_verified_at == null) {
        $phoneNumber = (new SecurityService())->authentication->requestPhoneNumberVerificationOtp($user);
        throw new PhoneNumberNotVerifiedException($phoneNumber);
      }
    }

    return $next($request);
  }
}
