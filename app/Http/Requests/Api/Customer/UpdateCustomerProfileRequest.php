<?php

namespace App\Http\Requests\Api\Customer;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerProfileRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('profile-update','api');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'string',
      'password' => 'min:6',
      'email' => ['string', 'email', Rule::unique('customers', 'email')->ignore(Auth::user()->id)],
      'phone_number' => 'string',

    ];
  }
}
