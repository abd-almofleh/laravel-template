<?php

namespace App\Http\Requests\Global;

use Illuminate\Foundation\Http\FormRequest;

class RequestHorseCareRequest extends FormRequest
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
      'horse_type'      => 'required|string',
      'sickness'        => 'required|string',
      'description'     => 'required|string|max:5000',

    ];
  }
}
