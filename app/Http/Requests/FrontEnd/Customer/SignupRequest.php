<?php

namespace App\Http\Requests\FrontEnd\Customer;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
      'password'     => 'required|min:6|confirmed',
      'email'        => ['required', 'string', 'email', 'unique:customers,email'],
      'phone_number' => 'required|string',
      'birth_date'   => 'required|date_format:Y-m-d|date',
    ];
  }

  public function messages()
  {
    return [
      'email.required'        => __('auth.form.validation.email.required'),
      'email.email'           => __('auth.form.validation.email.email'),
      'password.required'     => __('auth.form.validation.password.required'),
    ];
  }
}
