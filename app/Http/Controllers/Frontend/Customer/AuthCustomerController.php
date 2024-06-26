<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Enums\OtpTypesEnum;
use App\Exceptions\ExpiredOTPException;
use App\Exceptions\PhoneAlreadyVerifiedException;
use App\Exceptions\WrongOTPException;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\Customer\LoginRequest;
use App\Http\Requests\Frontend\Customer\ResetPasswordRequest;
use App\Http\Requests\FrontEnd\Customer\SignupRequest;
use App\Http\Requests\Frontend\Customer\UpdatePasswordRequest;
use App\Http\Requests\Global\UpdatePhoneNumberRequest;
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
use Illuminate\Http\Request;

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
      'updatePhoneNumberView',
      'updatePhoneNumber',
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

  public function requestResetPasswordView(Request $request): View
  {
    $request->session()->forget('resetPassword');
    return view('frontend.Customer.auth.forget-password');
  }

  public function requestResetPassword(ResetPasswordRequest $request): RedirectResponse
  {
    $email = $request->email;
    $customer = Customer::whereEmail($email)->first();
    if ($customer === null) {
      Toastr::error(__('frontend/validation.email_not_found'));
      return redirect()->back();
    }
    $phoneNumber = $this->security->authentication->requestResetPasswordThroughPhoneNumber($customer);

    $request->session()->forget('resetPassword');
    $request->session()->put('resetPassword.email', $email);

    Toastr::success(__('frontend/default.form.messages.reset_password.sent', ['phone_number' => $phoneNumber]));
    return redirect()->route('customer.auth.reset_password.validate.view');
  }

  public function validateResetPasswordOTPView(Request $request): View|RedirectResponse
  {
    if (!$request->session()->has('resetPassword.email')) {
      Toastr::error(__('frontend/default.form.messages.reset_password.no_email'));
      return redirect()->route('customer.auth.reset_password.form');
    }
    $request->session()->forget('resetPassword.otp');

    return view('frontend.Customer.auth.validate-reset-password-otp');
  }

  public function validateResetPasswordOTP(ValidateOtpRequest $request)
  {
    if (!$request->session()->has('resetPassword.email')) {
      Toastr::error(__('frontend/default.form.messages.reset_password.no_email'));
      return redirect()->route('customer.auth.reset_password.form');
    }

    $email = $request->session()->get('resetPassword.email');
    $otp = $request->otp;

    $customer = Customer::findByEmail($email);
    if ($customer == null) {
      toastr()->error(__('default.errors.customer_not_found'));
      return redirect()->route('customer.auth.reset_password.form');
    }

    try {
      $this->security->authentication->checkResetPasswordOTP($customer, $otp);
    } catch(WrongOTPException $ex) {
      $message = $ex->getMessage();
      Toastr::error($message);
      return redirect()->route('customer.auth.reset_password.validate.view');
    } catch(ExpiredOTPException $ex) {
      $message = $ex->getMessage();
      Toastr::error($message);
      $this->security->authentication->requestResetPasswordThroughPhoneNumber($customer);
      return redirect()->route('customer.auth.reset_password.validate.view');
    }
    $request->session()->put('resetPassword.otp', $otp);
    return redirect()->route('customer.auth.reset_password.new_password.view');
  }

  public function resetPasswordView(Request $request)
  {
    if (!$request->session()->has('resetPassword.email') || !$request->session()->has('resetPassword.otp')) {
      Toastr::error(__('frontend/default.form.messages.reset_password.no_email'));
      return redirect()->route('customer.auth.reset_password.form');
    }
    return view('frontend.Customer.auth.reset-password');
  }

  public function resetPassword(UpdatePasswordRequest $request)
  {
    if (!$request->session()->has('resetPassword.email') || !$request->session()->has('resetPassword.otp')) {
      Toastr::error(__('frontend/default.form.messages.reset_password.no_email'));
      return redirect()->route('customer.auth.reset_password.form');
    }
    $email = $request->session()->get('resetPassword.email');
    $password = $request->password;
    $otp = $request->session()->get('resetPassword.otp');
    $customer = Customer::findByEmail($email);

    if ($customer == null) {
      toastr()->error(__('default.errors.customer_not_found'));
      return redirect()->route('customer.auth.reset_password.form');
    }

    try {
      $this->security->authentication->resetPasswordOTP($customer, $otp, $password);
    } catch(WrongOTPException $ex) {
      $message = $ex->getMessage();
      Toastr::error($message);
      return redirect()->route('customer.auth.reset_password.validate.view');
    } catch(ExpiredOTPException $ex) {
      $message = $ex->getMessage();
      Toastr::error($message);
      $this->security->authentication->requestResetPasswordThroughPhoneNumber($customer);
      return redirect()->route('customer.auth.reset_password.validate.view');
    }
    toastr()->success(__('default.general.password_updated'));

    $request->session()->forget('resetPassword');

    return redirect()->route('customer.auth.login');
  }

  public function requestResetPasswordThroughPhoneNumber(Request $request): JsonResponse
  {
    $email = $request->session()->get('resetPassword.email');
    $customer = Customer::findByEmail($email);

    if ($customer == null) {
      toastr()->error(__('default.errors.customer_not_found'));
      return redirect()->route('customer.auth.reset_password.form');
    }

    $phoneNumber = $this->security->authentication->requestResetPasswordThroughPhoneNumber($customer);
    Toastr::success(__('frontend/default.form.messages.phone_number.sent', [$phoneNumber]));

    return $this->response('Otp sent to your phone', ['phone_number' => $phoneNumber]);
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
    $verificationCode = OtpVerificationCode::where('customer_id', $customer->id)->where('type', OtpTypesEnum::PhoneNumber)->latest('updated_at')->first();
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
    try {
      $this->security->authentication->validatePhoneNumberThoughOTP($customer, $otp);
    } catch (PhoneAlreadyVerifiedException $ex) {
      $message = $ex->getMessage();
      Toastr::error($message);
      return redirect()->route('home');
    } catch(WrongOTPException $ex) {
      $message = $ex->getMessage();
      Toastr::error($message);
      return redirect()->route('customer.auth.account.validate_phone_number.view');
    } catch(ExpiredOTPException $ex) {
      $message = $ex->getMessage();
      Toastr::error($message);
      $this->security->authentication->requestPhoneNumberVerificationOtp($customer);
      return redirect()->route('customer.auth.account.validate_phone_number.view');
    }

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

  public function updatePhoneNumberView(): View|RedirectResponse
  {
    $customer = Auth::guard(static::$guard)->user();
    if ($customer->phone_verified_at != null) {
      toastr()->error(__('default.general.phone_already_verified'));
      return redirect()->route('home');
    }

    $currentPhoneNumber = $customer->phone_number;
    return view('frontend.Customer.auth.change-phone-number', compact('currentPhoneNumber'));
  }

  public function updatePhoneNumber(UpdatePhoneNumberRequest $request): RedirectResponse
  {
    $customersPhoneNumber = $request->phone_number;
    $customer = Auth::guard(static::$guard)->user();
    try {
      $phoneNumber = $this->security->authentication->updatePhoneNumber($customer, $customersPhoneNumber);
    } catch (\Symfony\Component\HttpKernel\Exception\HttpException $th) {
      $message = $th->getMessage();
      $statusCode = $th->getStatusCode();
      if ($statusCode === 401) {
        toastr()->error($message);
        return redirect()->route('home');
      }
      throw $th;
    }
    toastr()->success(__('default.general.phone_number_changed_with_phone_number', ['new_phone_number' => $phoneNumber]));
    return redirect()->route('customer.auth.account.validate_phone_number.view');
  }
}
