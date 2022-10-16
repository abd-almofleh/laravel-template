<?php

namespace App\Http\Requests\Admin\Horses\ListedHorses;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateListedHorseRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('listedHorses-edit');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'string',
      'sex' => 'boolean',
      'type_id' => 'exists:horse_types,id',
      'race' => 'string',
      'birth_year' => 'numeric',
      'passport_type_id' => 'exists:horse_passports,id',
      'height' => 'numeric',
      'weight' => 'numeric',
      'color' => 'string',
      'health' => 'string',
      'contact_number' => 'string',
      'father_name' => 'string',
      'mother_name' => 'string',
      'description' => 'string',
      'meta_title' => 'string',
      'meta_description' => 'string',
      'meta_keywords' => 'string',
      'photos' => 'array',
      'videos' => 'array',
      'videos.*' => 'string',
      'photos.*' => 'string',

    ];
  }
}
