<?php

namespace App\Http\Controllers\Frontend\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\Customer\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

/*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|
*/
class LoginCustomerController extends Controller
{
  use AuthenticatesUsers;
  protected $guard = 'customer_frontend';

  public function __construct()
  {
    $this->middleware('guest:customer_frontend')->except('logout');
  }

  public function index()
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

  public function logout()
  {
    Auth::guard($this->guard)->logout();
    return redirect()->route('home');
  }
}
