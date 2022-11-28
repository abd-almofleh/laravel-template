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
  public static $guard = 'api';

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
      $token = $this->security->authentication->createApiToken($customer, 'customer');

      return $this->response('success', ['user' => $customer, 'access_token' => $token]);
    }

    /**
     * It takes an email and a new password, and then it calls the resetPassword function in the
     * Authentication class
     *
     * @param ResetPasswordRequest request The request object
     *
     * @return JsonResponse A JsonResponse object.
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
      $email = $request->email;
      $new_password = $request->new_password;
      $this->security->authentication->resetPassword($email, $new_password);

      return $this->response('success');
    }

    /**
     * It checks if a customer exists in the database, and if so, returns the customer's information.
     *
     * @param CheckCustomerEmailRequest request The request object
     *
     * @return JsonResponse The response is a JSON object with a status and a data object.
     */
    public function checkCustomerEmail(CheckCustomerEmailRequest $request): JsonResponse
    {
      $email = $request->email;
      $customer = $this->security->authentication->checkCustomerEmail($email);

      return $this->response('success', compact('customer'));
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

    public function deleteAccount()
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

    public function validateOtp(Request $request)
    {
      $customer = Auth::guard(static::$guard)->user();
      $otp = $request->otp;
      $result = $this->security->authentication->validateOtp($customer,$otp );

      return $this->response($result);
    }
}
