<?php

namespace App\Http\Requests\Admin\Horses\ListedHorses;

use App\Enums\HorseGender;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateListedHorseRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('listedHorses:edit');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'             => 'string',
      'gender'           => ['nullable', 'string', Rule::in(HorseGender::values())],
      'type_id'          => 'exists:horse_types,id',
      'race'             => 'string',
      'birth_year'       => 'numeric',
      'passport_type_id' => 'exists:horse_passports,id',
      'height'           => 'numeric',
      'color'            => 'string',
      'health'           => 'string',
      'contact_number'   => 'string|regex:/^(9715)\d{8}$/i',
      'location'         => 'string',
      'description'      => 'string',
      'meta_title'       => 'string',
      'meta_description' => 'string',
      'meta_keywords'    => 'string',
      'photos'           => 'array',
      'videos'           => 'array',
      'videos.*'         => 'string',
      'photos.*'         => 'string',

    ];
  }
}
