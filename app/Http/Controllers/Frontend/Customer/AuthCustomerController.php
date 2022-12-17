<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Enums\OtpTypesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\Customer\LoginRequest;
use App\Http\Requests\Frontend\Customer\ResetPasswordRequest;
use App\Http\Requests\FrontEnd\Customer\SignupRequest;
use App\Http\Requests\FrontEnd\Customer\ValidateOtpRequest;
use App\Models\Customer;
use App\Models\OtpVerificationCode;
use App\Services\Security\SecurityService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AuthCustomerController extends Controller
{
  use AuthenticatesUsers;
  public static $guard = 'customer_frontend';
  private $security;

  public function __construct(SecurityService $security)
  {
    $this->middleware('guest:customer_frontend')->except([
      'logout',
      'deleteAccount',
      'validatePhoneNumber',
      'validatePhoneNumberView',
      'requestPhoneNumberVerificationOtp',
    ]);
    $this->security = $security;
  }

  /**
   * It returns the login view
   *
   * @return View A view
   */
  public function loginView(): View
  {
    return view('frontend.customer.auth.login');
  }

  /**
   * It checks if the user is authenticated or not.
   *
   * @param LoginRequest request The request object.
   *
   * @return RedirectResponse The login method is returning a redirect to the home route.
   */
  public function login(LoginRequest $request): RedirectResponse
  {
    $data = $request->validated();

    if (!isset(request()->remember)) {
      $data['remember'] = false;
    }

    if (Auth::guard(static::$guard)->attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
      Toastr::success('Welcome!');
      return redirect()->route('home');
    } else {
      Toastr::error('Credentials Miss match!');
      return redirect()->back();
    }
  }

  public function signupForm(): View
  {
    return view('frontend.customer.auth.signup');
  }

  public function signup(SignupRequest $request): RedirectResponse
  {
    $data = [
      'name'         => $request->input('name'),
      'password'     => $request->input('password'),
      'email'        => $request->input('email'),
      'phone_number' => $request->input('phone_number'),
      'birth_date'   => $request->input('birth_date'),
    ];

    $customer = $this->security->authentication->register_customer($data);
    Auth::guard('customer_frontend')->login($customer, true);

    return redirect()->route('home');
  }

  public function forgetPasswordView(): View
  {
    return view('frontend.Customer.auth.forget-password');
  }

  public function resetPassword(ResetPasswordRequest $request): RedirectResponse
  {
    $data = $request->validated();
    $customer = Customer::whereEmail($data['email'])->first();
    if ($customer === null) {
      Toastr::error(__('frontend/validation.email_not_found'));
      return redirect()->back();
    }

    $customer->password = $data['password'];
    $customer->save();
    Toastr::success(__('frontend/default.form.messages.update.success'));

    return redirect()->route('customer.auth.login');
  }

  public function logout(): RedirectResponse
  {
    Auth::guard(static::$guard)->logout();
    return redirect()->route('home');
  }

  public function deleteAccount(): RedirectResponse
  {
    $customer = Auth::guard(static::$guard)->user();
    $result = $this->security->authentication->deleteCustomer($customer);

    if ($result) {
      Auth::guard(static::$guard)->logout();
      Toastr::success(__('frontend/default.form.messages.delete.success'));
    } else {
      Toastr::error(__('frontend/default.form.messages.delete.failed'));
    }

    return redirect()->route('home');
  }

  public function validatePhoneNumberView(): View
  {
    $customer = Auth::guard(static::$guard)->user();
    $verificationCode = OtpVerificationCode::where('customer_id', $customer->id)->where('type', OtpTypesEnum::PhoneNumber)->latest()->first();
    $now = Carbon::now();
    if (!($verificationCode && $now->isBefore($verificationCode->expire_at))) {
      $this->security->authentication->requestPhoneNumberVerificationOtp($customer);
    }
    return view('frontend.Customer.auth.validate-phone-number');
  }

  public function validatePhoneNumber(ValidateOtpRequest $request): RedirectResponse
  {
    $customer = Auth::guard(static::$guard)->user();
    $otp = $request->otp;
    $this->security->authentication->validatePhoneNumberThoughOTP($customer, $otp);

    Toastr::success(__('frontend/default.form.messages.phone_number.verified'));

    return redirect()->route('home');
  }

  /**
   * It sends an OTP to the user's phone number
   *
   * @return JsonResponse A JsonResponse object is being returned.
   */
  public function requestPhoneNumberVerificationOtp(): JsonResponse
  {
    $customer = Auth::guard(static::$guard)->user();

    $phoneNumber = $this->security->authentication->requestPhoneNumberVerificationOtp($customer);
    Toastr::success(__('frontend/default.form.messages.phone_number.sent', [$phoneNumber]));

    return $this->response('Otp sent to your phone', ['phone_number' => $phoneNumber]);
  }
}
