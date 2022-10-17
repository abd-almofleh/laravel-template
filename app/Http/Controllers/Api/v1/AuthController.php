<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\Auth\RegisterCustomerRequest;
use Illuminate\Http\Request;
use App\Services\Security\SecurityService;

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
  }

    public function login(Request $request)
    {
      $password = $request->input('password');
      $email = $request->input('email');
      $data = $this->security->authentication->login_customer($email, $password);

      return $this->response('success', $data);
    }

    public function register(RegisterCustomerRequest $request)
    {
      $name = $request->input('name');
      $password = $request->input('password');
      $email = $request->input('email');
      $phone_number = $request->input('phone_number');

      $customer = $this->security->authentication->register_customer($name, $password, $email, $phone_number);
      $token = $this->security->authentication->createApiToken($customer, 'customer');

      return $this->response('success', ['user' => $customer, 'access_token' => $token]);
    }

    // public function sendEmailResetPassword(): \Illuminate\ php artisan passport:install Http\Response
    // {
  //   if (!$email = \request()->get('email')) {
  //     throw new \InvalidArgumentException('Email is required!');
  //   }

  //   /** @var User $user */
  //   $user = User::where('email', $email)->first();
  //   if ($user) {
  //     $user->sendEmailResetPassword();
  //   } else {
  //     abort(404, 'Account not found!');
  //   }

  //   return response()->noContent();
    // }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function logout(Request $request): \Illuminate\Http\JsonResponse
    // {
  //   $request->user()->token()->revoke();
  //   return response()->json([
  //     'message' => 'Successfully logged out',
  //   ]);
    // }->provider_id = $userDetails->id;
}
