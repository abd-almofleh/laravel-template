<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterCustomerRequest;
use App\Http\Requests\Api\Auth\RequestOtpRequest;
use App\Http\Requests\Api\Auth\RequestResetPasswordRequest;
use App\Http\Requests\Api\Auth\ValidateOtpRequest;
use App\Http\Requests\Api\Auth\CheckResetPasswordOTPRequest;
use App\Http\Requests\Api\Auth\ResetPasswordOTPRequest;
use App\Http\Requests\Api\Auth\UpdatePhoneNumberRequest;
use App\Models\Customer;
use App\Services\Security\SecurityService;
use Auth;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api\v1
 */
class AuthController extends \App\Http\Controllers\Controller
{
  private $security;
  public static $guard = 'api';

  /**
   * > The constructor function is called when the class is instantiated
   *
   * @param SecurityService security This is the service that was created by laravel and bond to this controller.
   */
  public function __construct(SecurityService $security)
  {
    $this->security = $security;
  }

  /**
   * It takes a LoginRequest object, authenticates the user, and returns a JsonResponse object
   *
   * @param LoginRequest request The request object
   *
   * @return JsonResponse The response is being returned as a JsonResponse.
   */
  public function login(LoginRequest $request): JsonResponse
  {
    $password = $request->input('password');
    $email = $request->input('email');
    $data = $this->security->authentication->login_customer($email, $password);

    return $this->response('success', $data);
  }

  /**
   * It takes a request, creates a customer, creates a token, and returns a response
   *
   * @param RegisterCustomerRequest request The request object
   *
   * @return JsonResponse The response is being returned as a JsonResponse.
   */
  public function register(RegisterCustomerRequest $request): JsonResponse
  {
    $data = [
      'name'         => $request->input('name'),
      'password'     => $request->input('password'),
      'email'        => $request->input('email'),
      'phone_number' => $request->input('phone_number'),
      'birth_date'   => $request->input('birth_date'),
    ];
    $customer = $this->security->authentication->register_customer($data);

    return $this->response('Otp sent to your phone', ['phone_number' => $customer->phone_number]);
  }

  /**
   * It sends an OTP to the customer's phone number to validate the reset password process
   *
   * @param ResetPasswordRequest request The request object.
   *
   * @return JsonResponse A JsonResponse object.
   */
  public function requestResetPasswordThroughPhoneNumber(RequestResetPasswordRequest $request): JsonResponse
  {
    $customer_email = $request->email;
    $customer = Customer::findByEmailOrFail($customer_email);

    $this->security->authentication->requestResetPasswordThroughPhoneNumber($customer);

    return $this->response('Otp sent to your phone');
  }

  /**
   * checks the OTP sent to the customer's phone number
   *
   * @param CheckResetPasswordOTPRequest request The request object.
   *
   * @return JsonResponse A JsonResponse object.
   */
  public function checkResetPasswordOTP(CheckResetPasswordOTPRequest $request): JsonResponse
  {
    $customer_email = $request->email;
    $otp = $request->otp;

    $customer = Customer::findByEmailOrFail($customer_email);

    $this->security->authentication->checkResetPasswordOTP($customer, $otp);

    return $this->response('success');
  }

  /**
   * resets the password of a customer using the OTP sent to the customer's phone number
   *
   * @param ResetPasswordOTPRequest request The request object.
   *
   * @return JsonResponse A JsonResponse object with the message "Password reseted successfully"
   */
  public function resetPasswordOTP(ResetPasswordOTPRequest $request): JsonResponse
  {
    $customer_email = $request->email;
    $otp = $request->otp;
    $password = $request->password;

    $customer = Customer::findByEmailOrFail($customer_email);

    $this->security->authentication->resetPasswordOTP($customer, $otp, $password);

    return $this->response('Password reseted successfully');
  }

  /**
   * It logs out the user by calling the `logOutCustomer` function on the `authentication` object of the
   * `security` object
   *
   * @return JsonResponse A JsonResponse object.
   */
  public function logout(): JsonResponse
  {
    $customer = Auth::guard(static::$guard)->user();

    $this->security->authentication->logOutCustomer($customer);
    return $this->response('Successfully logged out');
  }

  /**
   * It deletes the customer's account and logs them out
   *
   * @return JsonResponse A JsonResponse object.
   */
  public function deleteAccount(): JsonResponse
  {
    $customer = Auth::guard(static::$guard)->user();
    $result = $this->security->authentication->deleteCustomer($customer);

    if ($result) {
      $this->security->authentication->logOutCustomer($customer);

      $message = __('frontend/default.form.messages.delete.success');
    } else {
      $message = __('frontend/default.form.messages.delete.failed');
    }

    return $this->response($message);
  }

  /**
   * It sends an OTP to the customer's phone number
   *
   * @param RequestOtpRequest request The request object
   *
   * @return JsonResponse A json response with the message 'Otp sent to your phone'
   */
  public function requestPhoneNumberVerificationOtp(RequestOtpRequest $request): JsonResponse
  {
    $customer_email = $request->email;

    $customer = Customer::findByEmailOrFail($customer_email);

    $phoneNumber = $this->security->authentication->requestPhoneNumberVerificationOtp($customer);

    return $this->response('Otp sent to your phone', ['phone_number' => $phoneNumber]);
  }

  /**
   * It validates the OTP sent to the customer's phone number and returns a JsonResponse with the
   * customer's details and an access token
   *
   * @param ValidateOtpRequest request The request object.
   *
   * @return JsonResponse A JsonResponse object is being returned.
   */
  public function validatePhoneNumberThroughOTP(ValidateOtpRequest $request): JsonResponse
  {
    $customer_email = $request->email;
    $otp = $request->otp;

    $customer = Customer::findByEmailOrFail($customer_email);

    $this->security->authentication->validatePhoneNumberThoughOTP($customer, $otp);
    $token = $this->security->authentication->createApiToken($customer, 'customer');

    return $this->response('success', ['user' => $customer, 'access_token' => $token]);
  }

  /**
   * It updates the phone number of a customer and sends an otp to the new phone number
   *
   * @param UpdatePhoneNumberRequest request The request object that contains the email and phone number
   * of the customer.
   *
   * @return JsonResponse A JsonResponse with the message 'Phone Number has been changed and an otp has
   *                      been sent to your phone' and the phone number.
   */
  public function updatePhoneNumber(UpdatePhoneNumberRequest $request): JsonResponse
  {
    $customersEmail = $request->email;
    $customersPhoneNumber = $request->phone_number;
    $customer = Customer::findByEmailOrFail($customersEmail);

    $phoneNumber = $this->security->authentication->updatePhoneNumber($customer, $customersPhoneNumber);

    return $this->response(__('default.general.phone_number_changed'), ['phone_number' => $phoneNumber]);
  }
}
