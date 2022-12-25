<?php

namespace App\Http\Requests\Global;

use App\Enums\HorseGender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
      'gender'         => ['nullable', 'boolean', Rule::in(HorseGender::values())],
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
