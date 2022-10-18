<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\Customer\UpdateCustomerProfileRequest;
use Auth;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Api\v1
 */
class ProfileController extends \App\Http\Controllers\Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

    public function index()
    {
      $user = Auth::user();

      return $this->response('success', ['user' => $user]);
    }

    public function update(UpdateCustomerProfileRequest $request)
    {
      $data = $request->validated();
      $user = Auth::user();
      $user->update($data);

      return $this->response('success', ['user' => $user]);
    }
}
