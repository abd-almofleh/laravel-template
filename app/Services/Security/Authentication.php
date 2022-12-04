<?php

namespace App\Services\Security;

use App\Enums\OtpTypesEnum;
use App\Models\Customer;
use App\Helpers\Random;
use App\Jobs\SendOTPJob;
use App\Models\OtpVerificationCode;
use Carbon\Carbon;
use Exception;
use Hash;

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

    $this->sendOTP($customer, OtpTypesEnum::PhoneNumber);

    return $customer;
  }

  /**
   * It checks if the customer has an OTP code that is not expired, if yes, it returns the code, if not,
   * it generates a new one and returns it
   *
   * @param Customer customer The customer object
   */
  private function sendOTP(Customer $customer, OtpTypesEnum $type): void
  {
    if (!$type) {
      throw new Exception('Otp Type is Required');
    }

    $verificationCode = OtpVerificationCode::where('customer_id', $customer->id)->where('type', $type)->latest()->first();
    $now = Carbon::now();
    $otpCode = '';
    if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
      $otpCode = $verificationCode->otp;
    } else {
      $otpCode = Random::Numbers();
      OtpVerificationCode::create([
        'customer_id' => $customer->id,
        'otp'         => $otpCode,
        'expire_at'   => Carbon::now()->addMinutes(5),
        'type'        => $type,
      ]);
    }
    SendOTPJob::dispatch($customer->phone_number, $otpCode);
  }

  /**
   * It checks if the OTP is correct and not expired
   *
   * @param Customer customer The customer object
   * @param string userOtp The OTP that the user has entered.
   */
  private function ValidateOTP(Customer $customer, string $userOtp, OtpTypesEnum $type): void
  {
    if (!$type) {
      throw new Exception('Otp Type is Required');
    }

    $verificationCode = OtpVerificationCode::query()
      ->where('customer_id', $customer->id)
      ->where('otp', 'LIKE', $userOtp)
      ->where('type', 'LIKE', $type)
      ->latest('expire_at')
      ->first();

    $now = Carbon::now();
    if (!$verificationCode) {
      abort(401, 'Your OTP is not correct');
    } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
      abort(403, 'Your OTP has been expired');
    }
    $verificationCode->update([
      'expire_at' => Carbon::now(),
    ]);
  }

  /**
   * It validates the OTP sent to the user's phone number and updates the `phone_verified_at` column in
   * the database
   *
   * @param Customer customer The customer object
   * @param string userOtp The OTP that the user has entered.
   *
   * @return bool A boolean represent the success of the operation.
   */
  public function validatePhoneNumberThoughOTP(Customer $customer, string $userOtp): bool
  {
    if ($customer->phone_verified_at != null) {
      abort(401, 'Phone Number is already verified');
    }

    $this->ValidateOTP($customer, $userOtp, OtpTypesEnum::PhoneNumber);

    return $customer->update([
      'phone_verified_at' => Carbon::now(),
    ]);
  }

  /**
   * It sends an OTP to the customer's phone number
   *
   * @param Customer customer The customer object
   */
  public function requestPhoneNumberVerificationOtp(Customer $customer): void
  {
    if ($customer->phone_verified_at != null) {
      abort(401, 'Phone Number is already verified');
    }
    $this->sendOTP($customer, OtpTypesEnum::PhoneNumber);
  }

  /**
   * Return true if the customer's phone number is validated.
   *
   * @param Customer customer The customer object
   *
   * @return bool A boolean value.
   */
  public function isCustomerPhoneNumberIfValidated(Customer $customer): bool
  {
    return $customer->phone_verified_at !== null;
  }

  /**
   * It checks if the email and password are correct, and if they are, it check for the phone number if validated if it's validated it creates an access token and
   * returns the user and the access token.
   * If the phone number is not validated it return an error and send otp to the phone number to verify it.
   *
   * @param string email The email address of the user.
   * @param string password The password of the user
   *
   * @return array The user and the access token.
   */
  public function login_customer(string $email, string $password): array
  {
    $customer = Customer::where('email', 'LIKE', $email)->first();
    if (!$customer || !Hash::check($password, $customer->password)) {
      abort(response()->json([
        'status' => 'Not Found',
        'error'  => [
          'type'    => 'CREDENTIALS_ERROR',
          'message' => 'Invalid email or password',
        ],
      ], 404));
    }

    if (!$this->isCustomerPhoneNumberIfValidated($customer)) {
      $this->sendOTP($customer, OtpTypesEnum::PhoneNumber);
      abort(response()->json([
        'status' => 'Unauthorized',
        'error'  => [
          'type'    => 'PHONE_NOT_VERIFIED',
          'message' => 'Otp has been sent to you phone',
        ],
      ], 401));
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
    if (!$customer) {
      abort(404, 'Account not found!');
    }
    $customer->password = $new_password;
    $customer->save();
  }

  /**
   * It checks if the email address exists in the database, and if it does, it returns the customer
   * object. If it doesn't, it throws a 404 error.
   *
   * @param string email The email address of the customer.
   *
   * @return ?Customer The customer object.
   */
  public function checkCustomerEmail(string $email): Customer
  {
    $customer = Customer::where('email', $email)->first();
    if (!$customer) {
      abort(404, 'Account not found!');
    }
    return $customer;
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
