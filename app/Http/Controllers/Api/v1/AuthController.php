<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\Auth\RegisterCustomerRequest;
use App\Http\Requests\StoreUser;
use App\Models\Customer;
use App\SocialIdentity;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
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
}
