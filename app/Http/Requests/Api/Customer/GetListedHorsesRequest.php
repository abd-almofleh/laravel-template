<?php

namespace App\Http\Requests\Api\Customer;

use Illuminate\Foundation\Http\FormRequest;

class GetListedHorsesRequest extends FormRequest
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
      'query'          => 'nullable|string',
      'sex'            => 'nullable|boolean',
      'min_birth_year' => 'nullable|numeric',
      'max_birth_year' => 'nullable|numeric',
      'min_height'     => 'nullable|numeric|min:0',
      'max_height'     => 'nullable|numeric',
      'color'          => 'nullable|string',
      'type'           => 'nullable|numeric|min:0',
      'passport'       => 'nullable|numeric|min:0',
    ];
  }
}
