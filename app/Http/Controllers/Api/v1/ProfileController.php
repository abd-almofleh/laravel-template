<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\Customer\UpdateCustomerProfileRequest;
use App\Http\Requests\Global\UpdatePhoneNumberRequest;
use App\Services\Security\SecurityService;
use Auth;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Api\v1
 */
class ProfileController extends \App\Http\Controllers\Controller
{
  private $security;

  public function __construct(SecurityService $security)
  {
    $this->security = $security;
    $this->middleware('auth:api');
  }

    public function index()
    {
      $user = Auth::guard(AuthController::$guard)->user();

      return $this->response('success', ['user' => $user]);
    }

    public function update(UpdateCustomerProfileRequest $request)
    {
      $data = $request->validated();
      $user = Auth::guard(AuthController::$guard)->user();
      $user->update($data);

      return $this->response('success', ['user' => $user]);
    }

    public function updatePhoneNumber(UpdatePhoneNumberRequest $request)
    {
      $customer = Auth::guard(AuthController::$guard)->user();
      $phoneNumber = $request->phone_number;
      $this->security->authentication->updatePhoneNumber($customer, $phoneNumber, true);

      return $this->response(__('default.general.phone_number_changed'), ['phone_number' => $phoneNumber]);
    }
}
