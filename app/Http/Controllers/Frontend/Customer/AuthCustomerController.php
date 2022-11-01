<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\Customer\LoginRequest;
use App\Http\Requests\Frontend\Customer\ResetPasswordRequest;
use App\Models\Customer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class AuthCustomerController extends Controller
{
  use AuthenticatesUsers;
  protected $guard = 'customer_frontend';

  public function __construct()
  {
    $this->middleware('guest:customer_frontend')->except('logout');
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
    Auth::guard($this->guard)->logout();
    return redirect()->route('home');
  }
}
