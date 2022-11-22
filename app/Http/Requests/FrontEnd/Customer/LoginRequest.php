<?php

namespace App\Http\Requests\FrontEnd\Customer;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
      'email'     => 'required|email|max:255',
      'password'  => 'required|string',
      'remember'  => 'nullable|boolean',
    ];
  }

  public function messages()
  {
    return [
      'email.required'        => __('auth.form.validation.email.required'),
      'email.email'           => __('auth.form.validation.email.email'),
      'password.required'     => __('auth.form.validation.email.required'),
    ];
  }
}
