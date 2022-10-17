<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\Auth\CheckCustomerEmailRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterCustomerRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\Security\SecurityService;
use Auth;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api\v1
 */
class AuthController extends \App\Http\Controllers\Controller
{
  private $security;

  public function __construct(SecurityService $security)
  {
    $this->security = $security;

    $this->middleware('guest:api')->except('logout');
    $this->middleware('auth:api')->only('logout');
  }

    public function login(LoginRequest $request): JsonResponse
    {
      $password = $request->input('password');
      $email = $request->input('email');
      $data = $this->security->authentication->login_customer($email, $password);

      return $this->response('success', $data);
    }

    public function register(RegisterCustomerRequest $request): JsonResponse
    {
      $name = $request->input('name');
      $password = $request->input('password');
      $email = $request->input('email');
      $phone_number = $request->input('phone_number');

      $customer = $this->security->authentication->register_customer($name, $password, $email, $phone_number);
      $token = $this->security->authentication->createApiToken($customer, 'customer');

      return $this->response('success', ['user' => $customer, 'access_token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
      $email = $request->email;
      $new_password = $request->new_password;
      $this->security->authentication->resetPassword($email, $new_password);

      return $this->response('success');
    }

    public function checkCustomerEmail(CheckCustomerEmailRequest $request): JsonResponse
    {
      $email = $request->email;
      $customer = $this->security->authentication->checkCustomerEmail($email);

      return $this->response('success', compact('customer'));
    }

    public function logout(): JsonResponse
    {
      $this->security->authentication->logOutCustomer(Auth::user());
      return $this->response('Successfully logged out');
    }
}
