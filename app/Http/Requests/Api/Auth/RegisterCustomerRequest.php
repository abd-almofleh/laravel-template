<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterCustomerRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'         => 'required|string',
      'password'     => 'required|min:6',
      'email'        => ['required', 'string', 'email', Rule::unique('customers', 'email')->where('deleted_at', null)],
      'phone_number' => 'required|string|regex:/^(9715)\d{8}$/i',
      'birth_date'   => 'required|date_format:Y-m-d|date',
    ];
  }
}
