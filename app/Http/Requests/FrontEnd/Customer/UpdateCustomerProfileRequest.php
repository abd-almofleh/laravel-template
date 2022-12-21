<?php

namespace App\Http\Requests\FrontEnd\Customer;

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
    return Auth::user()->can('profile:update', 'customer_frontend');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'         => 'nullable|string',
      'password'     => 'nullable|min:6',
      'email'        => ['nullable', 'string', 'email', Rule::unique('customers', 'email')->ignore(Auth::user()->id)],
      'phone_number' => 'nullable|string|regex:/^(9715)\d{8}$/i',
      'birth_date'   => 'required|date_format:Y-m-d|date',
    ];
  }
}
