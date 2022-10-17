<?php

namespace App\Services\Security;

use App\Models\Customer;
use Auth;
use Exception;
use Hash;
use Illuminate\Auth\AuthenticationException;

class Authentication
{
  public function register_customer(string $name, string $password, string $email, string $phone_number)
  {
    $customer = Customer::create([
      'name' => $name,
      'password' => $password,
      'email' => $email,
      'phone_number' => $phone_number,
    ]);

    if (!$customer) {
      throw new Exception('Error while creating a user');
    }

    return $customer;
  }

  public function login_customer(string $email, string $password)
  {
    $customer = Customer::where('email', 'LIKE', $email)->first();
    if (!$customer || !Hash::check($password, $customer->password)) {
      throw new AuthenticationException('Invalid username or password');
    }

    $accessToken = $this->createApiToken($customer);

    return ['user' => $customer, 'access_token' => $accessToken];
  }

  public function createApiToken($user, $tag = 'authToken')
  {
    $token = $user->createToken($tag);

    return $token->accessToken;
  }

  public function resetPassword(string $email, string $new_password)
  {
    $customer = Customer::where('email', $email)->first();
    if ($customer) {
      $customer->password = $new_password;
      $customer->save();
    } else {
      abort(404, 'Account not found!');
    }

    return response()->noContent();
  }

  public function checkCustomerEmail(string $email)
  {
    $customer = Customer::where('email', $email)->first();
    if ($customer) {
      return $customer;
    } else {
      abort(404, 'Account not found!');
    }
  }
}
