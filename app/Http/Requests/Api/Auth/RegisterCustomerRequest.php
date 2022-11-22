<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

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
      'email'        => 'required|string|email|unique:customers',
      'phone_number' => 'required|string',
      'birth_date'   => 'required|date_format:d-m-Y|date',
    ];
  }
}
