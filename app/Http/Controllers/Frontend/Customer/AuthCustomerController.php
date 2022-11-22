<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\Customer\LoginRequest;
use App\Http\Requests\Frontend\Customer\ResetPasswordRequest;
use App\Http\Requests\FrontEnd\Customer\SignupRequest;
use App\Models\Customer;
use App\Services\Security\SecurityService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class AuthCustomerController extends Controller
{
  use AuthenticatesUsers;
  public static $guard = 'customer_frontend';
  private $security;

  public function __construct(SecurityService $security)
  {
    $this->middleware('guest:customer_frontend')->except(['logout', 'deleteAccount']);
    $this->security = $security;
  }

  public function loginView()
  {
    return view('frontend.customer.auth.login');
  }

  public function login(LoginRequest $request)
  {
    $data = $request->validated();

    if (!isset(request()->remember)) {
      $data['remember'] = false;
    }

    if (Auth::guard($this->guard)->attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
      Toastr::success('Welcome!');
      return redirect()->route('home');
    } else {
      Toastr::error('Credentials Miss match!');
      return redirect()->back();
    }
  }

  public function signupForm()
  {
    return view('frontend.customer.auth.signup');
  }

  public function signup(SignupRequest $request)
  {
    $name = $request->input('name');
    $password = $request->input('password');
    $email = $request->input('email');
    $phone_number = $request->input('phone_number');

    $customer = $this->security->authentication->register_customer($name, $password, $email, $phone_number);
    Auth::guard('customer_frontend')->login($customer, true);
    return redirect()->route('home');
  }

  public function forgetPasswordView()
  {
    return view('frontend.Customer.auth.forget-password');
  }

  public function resetPassword(ResetPasswordRequest $request)
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

  public function logout()
  {
    Auth::guard(static::$guard)->logout();
    return redirect()->route('home');
  }

  public function deleteAccount()
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
}
