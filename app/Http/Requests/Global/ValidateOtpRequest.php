<?php

namespace App\Http\Requests\Global;

use Illuminate\Foundation\Http\FormRequest;

class ValidateOtpRequest extends FormRequest
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
      'otp'   => 'required|string|min:6|max:6',
      'email' => 'required|string|email',
    ];
  }
}
