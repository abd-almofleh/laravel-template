<?php

namespace App\Services\Security;

use App\Enums\OtpTypesEnum;
use App\Exceptions\ExpiredOTPException;
use App\Exceptions\PhoneAlreadyVerifiedException;
use App\Exceptions\PhoneNumberNotVerifiedException;
use App\Exceptions\WrongOTPException;
use App\Models\Customer;
use App\Helpers\Random;
use App\Jobs\SendOTPJob;
use App\Models\OtpVerificationCode;
use Carbon\Carbon;
use Exception;
use Hash;

class Authentication
{
  /* -------------------------------------------------------------------------- */
  /*                               Private Methods                              */
  /* -------------------------------------------------------------------------- */

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
   * @param OtpTypesEnum type The type of OTP you want to send.
   *
   * @return string The phone number of the customer.
   */
  private function sendOTP(Customer $customer, OtpTypesEnum $type, bool $new = false): string
  {
    if (!$type) {
      throw new Exception('Otp Type is Required');
    }
    $otpCode = '';
    if (!$new) {
      $verificationCode = OtpVerificationCode::where('customer_id', $customer->id)->where('type', $type)->latest('updated_at')->first();
      $now = Carbon::now();
      if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
        $otpCode = $verificationCode->otp;
      } else {
        $otpCode = $this->createOtp($customer, $type);
      }
    } else {
      $this->expireAllOldOtp($customer, $type);
      $otpCode = $this->createOtp($customer, $type);
    }

    SendOTPJob::dispatch($customer->phone_number, $otpCode);
    return $customer->phone_number;
  }

  /**
   * It creates a random 6 digit number, saves it in the database, and returns it
   *
   * @param Customer customer The customer object
   * @param OtpTypesEnum type The type of OTP you want to send.
   *
   * @return string the generated OTP
   */
  private function createOtp(Customer $customer, OtpTypesEnum $type): string
  {
    $otpCode = Random::Numbers();
    OtpVerificationCode::create([
      'customer_id' => $customer->id,
      'otp'         => $otpCode,
      'expire_at'   => Carbon::now()->addMinutes(5),
      'type'        => $type,
    ]);
    return $otpCode;
  }

  /**
   * It validates the OTP.
   *
   * @param Customer customer The customer object
   * @param string userOtp The OTP that the user has entered.
   * @param OtpTypesEnum type The type of OTP you want to validate.
   *
   * @throws WrongOTPException
   * @throws ExpiredOTPException
   */
  private function ValidateOTP(Customer $customer, string $userOtp, OtpTypesEnum $type): void
  {
    if (!$type) {
      throw new Exception('Otp Type is Required');
    }

    $verificationCode = OtpVerificationCode::get($customer->id, $userOtp, $type);

    $now = Carbon::now();
    if (!$verificationCode) {
      throw new WrongOTPException();
    } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
      throw new ExpiredOTPException();
    }
    $this->expireAllOldOtp($customer, $type);
  }

  private function expireAllOldOtp(Customer $customer, OtpTypesEnum $type)
  {
    OtpVerificationCode::where('customer_id', $customer->id)->where('type', $type)->where('expire_at', '>', Carbon::now())->update([
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
      throw new PhoneAlreadyVerifiedException();
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
   *
   * @return string The phone number of the customer used to send the otp to.
   */
  public function requestPhoneNumberVerificationOtp(Customer $customer): string
  {
    if ($customer->phone_verified_at != null) {
      throw new PhoneAlreadyVerifiedException();
    }
    return $this->sendOTP($customer, OtpTypesEnum::PhoneNumber);
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
    if ($customer->is_otp_enabled && !$this->isCustomerPhoneNumberIfValidated($customer)) {
      $phoneNumber = $this->requestPhoneNumberVerificationOtp($customer);
      throw new PhoneNumberNotVerifiedException($phoneNumber);
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
   * This function sends an OTP to the customer's phone number for resetting the password
   *
   * @param Customer customer The customer object that the OTP will be sent to.
   */
  public function requestResetPasswordThroughPhoneNumber(Customer $customer): string
  {
    return $this->sendOTP($customer, OtpTypesEnum::ResetPassword);
  }

  /**
   * It checks if the OTP is correct and not expired
   *
   * @param Customer customer The customer object
   * @param string otp The OTP that the user has entered.
   */
  public function checkResetPasswordOTP(Customer $customer, string $otp): void
  {
    $verificationCode = OtpVerificationCode::get($customer->id, $otp, OtpTypesEnum::ResetPassword);
    $now = Carbon::now();
    if (!$verificationCode) {
      throw new WrongOTPException();
    } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
      throw new ExpiredOTPException();
    }
  }

  /**
   * It validates the OTP, sets the password and marks the phone as verified
   *
   * @param Customer customer The customer object
   * @param string otp The OTP that the user has entered.
   * @param string password The new password
   *
   * @throws ExpiredOTPException
   * @throws WrongOTPException
   *
   * @return bool A boolean value.
   */
  public function resetPasswordOTP(Customer $customer, string $otp, string $password): bool
  {
    $this->ValidateOTP($customer, $otp, OtpTypesEnum::ResetPassword);

    $customer->password = $password;
    if ($customer->phone_verified_at === null) {
      $customer->phone_verified_at = Carbon::now();
    }
    $customer->save();
    return true;
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

  /**
   * It updates the phone number of the customer and sends an OTP to the new phone number
   *
   * @param Customer customer The customer object
   * @param string phoneNumber The phone number to be updated.
   * @param bool force if true change the phone number even if its a verified account
   *
   * @return string The phone number of the customer used to send the otp to.
   */
  public function updatePhoneNumber(Customer $customer, string $phoneNumber, bool $force = false): string
  {
    if (!$force && $customer->phone_verified_at != null) {
      throw new PhoneAlreadyVerifiedException();
    }

    $customer->update([
      'phone_number'      => $phoneNumber,
      'phone_verified_at' => null,
    ]);
    return $this->sendOTP($customer, OtpTypesEnum::PhoneNumber, true);
  }
}
