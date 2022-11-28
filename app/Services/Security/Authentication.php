<?php

namespace App\Services\Security;

use App\Models\Customer;
use App\Helpers\Random;
use App\Jobs\SendOTPJob;
use App\Models\OtpVerificationCode;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Auth\AuthenticationException;

/* It creates a new customer, logs in a customer, resets a customer's password, checks if a customer's
email exists, and logs out a customer */
class Authentication
{
  /**
   * It creates a new user or restore a deleted user and send him an OTP
   *
   * @param array customerData An array of the customer data.
   *
   * @return Customer The customer object.
   */
  public function register_customer(array $customerData): Customer
  {
    $customer = Customer::withTrashed()->where('email', 'LIKE', $customerData['email'])->first();
    // If the user exists in the database it mean that it's deleted then we need to restore it.
    // It it doesn't exist it mean the user is new and we need to create a new account for him.
    if ($customer) {
      $customer->restore();
    } else {
      $customer = Customer::create([
        'name'         => $customerData['name'],
        'password'     => $customerData['password'],
        'email'        => $customerData['email'],
        'phone_number' => $customerData['phone_number'],
        'birth_date'   => $customerData['birth_date'],
      ]);
      $customer->assignRole('customer');
      if (!$customer) {
        throw new Exception('Error while creating a user');
      }
    }

    $this->sendOTP($customer);

    return $customer;
  }

  /**
   * It checks if the customer has an OTP code that is not expired, if yes, it returns the code, if not,
   * it generates a new one and returns it
   *
   * @param Customer The customer object
   */
  public function sendOTP(Customer $customer): void
  {
    $verificationCode = OtpVerificationCode::where('customer_id', $customer->id)->latest()->first();

    $now = Carbon::now();
    $otpCode = '';
    if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
      $otpCode = $verificationCode->otp;
    } else {
      $otpCode = Random::Numbers();
    //   dd($customer->id);
      OtpVerificationCode::create([
        'customer_id'   => $customer->id,
        'otp'           => $otpCode,
        'expire_at'     => Carbon::now()->addMinutes(5),
      ]);
    }
    SendOTPJob::dispatch($customer->phone_number, $otpCode);
  }

  public function ValidateOTP(Customer $customer, string $userOtp): void
  {
    $verificationCode = OtpVerificationCode::where('customer_id', $customer->ud)->where('otp', 'LIKE', $userOtp)->first();

    $now = Carbon::now();
    if (!$verificationCode) {
      throw new Exception('Your OTP is not correct', 401);
        //  send an exception:  ''
    } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
      // send an exception: Your OTP has been expired.
    }

    $verificationCode->update([
      'expire_at' => Carbon::now(),
    ]);
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
