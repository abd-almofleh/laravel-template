<?php

namespace App\Services\Security;

use App\Models\Customer;
use Exception;

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

  public function createApiToken($user, $tag = null)
  {
    $token = $user->createToken(($tag ? "_$tag" : ''));

    return $token->accessToken;
  }
}
