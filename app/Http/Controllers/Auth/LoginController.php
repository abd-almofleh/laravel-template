<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
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
  use AuthenticatesUsers;

  protected $redirectTo = RouteServiceProvider::HOME;
  protected $guard = 'admin';

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function login()
  {
    return view('admin.auth.login');
  }

  public function login_go(Request $request)
  {
    $rules = [
      'email'     => 'required|email|max:255',
      'password'  => 'required',
      'remember'  => 'nullable',
    ];

    $messages = [
      'email.required'        => __('auth.form.validation.email.required'),
      'email.email'           => __('auth.form.validation.email.email'),
      'email.exists'          => __('auth.form.validation.email.exists'),
      'password.required'     => __('auth.form.validation.email.required'),
    ];

    $data = $this->validate($request, $rules, $messages);

    if (!isset(request()->remember)) {
      $data['remember'] = 'off';
    }
    if (Auth::guard($this->guard)->attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
      if (Auth::guard($this->guard)->user()->status == 1) {
        Toastr::success('Welcome !');
        return redirect()->route('dashboard');
      } else {
        Auth::logout();
        Toastr::error('Your account is Deactivated by Admin!');
        return redirect()->back();
      }
    } else {
      Toastr::error('Credentials Missmatch!');
      return redirect()->back();
    }
  }

  public function logout()
  {
    Auth::guard($this->guard)->logout();
    return redirect('admin/login');
  }
}
