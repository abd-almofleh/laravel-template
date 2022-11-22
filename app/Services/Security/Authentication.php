<?php

namespace App\Services\Security;

use App\Models\Customer;
use Exception;
use Hash;
use Illuminate\Auth\AuthenticationException;

/* It creates a new customer, logs in a customer, resets a customer's password, checks if a customer's
email exists, and logs out a customer */
class Authentication
{
  /**
   * It creates a new customer in the database
   *
   * @param string name The name of the customer
   * @param string password The password for the user.
   * @param string email The email address of the customer.
   * @param string phone_number +923331234567
   *
   * @return Customer The customer object.
   */
  public function register_customer(string $name, string $password, string $email, string $phone_number): Customer
  {
    $customer = Customer::create([
      'name'         => $name,
      'password'     => $password,
      'email'        => $email,
      'phone_number' => $phone_number,
    ]);

    if (!$customer) {
      throw new Exception('Error while creating a user');
    }

    return $customer;
  }

  /**
   * It checks if the email and password are correct, and if they are, it creates an access token and
   * returns the user and the access token.
   *
   * @param string email The email address of the user.
   * @param string password The password of the user
   *
   * @return The user and the access token.
   */
  public function login_customer(string $email, string $password): array
  {
    $customer = Customer::where('email', 'LIKE', $email)->first();
    if (!$customer || !Hash::check($password, $customer->password)) {
      throw new AuthenticationException('Invalid username or password');
    }

    $accessToken = $this->createApiToken($customer);

    return ['user' => $customer, 'access_token' => $accessToken];
  }

  /**
   * It creates a token for the user and returns the access token
   *
   * @param user The user object that you want to create a token for.
   * @param tag The tag is used to identify the token.
   *
   * @return string The access token.
   */
  public function createApiToken($user, $tag = 'authToken'): string
  {
    $token = $user->createToken($tag);

    return $token->accessToken;
  }

  /**
   * It takes an email and a new password, finds the customer with that email, and sets the password to
   * the new password.
   *
   * @param string email The email address of the customer.
   * @param string new_password The new password for the account.
   */
  public function resetPassword(string $email, string $new_password): void
  {
    $customer = Customer::where('email', $email)->first();
    if ($customer) {
      $customer->password = $new_password;
      $customer->save();
    } else {
      abort(404, 'Account not found!');
    }
  }

  /**
   * It checks if the email address exists in the database, and if it does, it returns the customer
   * object. If it doesn't, it throws a 404 error.
   *
   * @param string email The email address of the customer.
   *
   * @return ?Customer The customer object.
   */
  public function checkCustomerEmail(string $email): ?Customer
  {
    $customer = Customer::where('email', $email)->first();
    if ($customer) {
      return $customer;
    } else {
      abort(404, 'Account not found!');
    }
  }

  /**
   * It revokes the token of the user that is passed to it
   *
   * @param user The user object that you want to log out.
   */
  public function logOutCustomer(Customer $customer): void
  {
    $customer->token()->revoke();
  }

  /**
   *  Delete a customer from the database
   *
   * @param Customer customer
   *
   * @return bool the result of the operation.
   */
  public function deleteCustomer(Customer $customer): bool
  {
    return $customer->delete();
  }
}
