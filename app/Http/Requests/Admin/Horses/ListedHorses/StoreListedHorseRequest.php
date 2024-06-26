<?php

namespace App\Http\Requests\Admin\Horses\ListedHorses;

use App\Enums\HorseGender;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreListedHorseRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('listedHorses:create');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'             => 'required|string',
      'gender'           => ['required', 'string', Rule::in(HorseGender::values())],
      'type_id'          => 'required|exists:horse_types,id',
      'race'             => 'required|string',
      'birth_year'       => 'required|numeric|min:2000',
      'passport_type_id' => 'required|exists:horse_passports,id',
      'height'           => 'required|numeric',
      'color'            => 'required|string',
      'health'           => 'required|string',
      'location'         => 'required|string',
      'contact_number'   => 'required|string|regex:/^(9715)\d{8}$/i',
      'description'      => 'required|string',
      'meta_title'       => 'required|string',
      'meta_description' => 'required|string',
      'meta_keywords'    => 'required|string',
      'photos'           => 'array',
      'videos'           => 'array',
      'videos.*'         => 'string',
      'photos.*'         => 'string',

    ];
  }
  // TODO:
  // public function messages()
  // {
  //   return [
  //     'name.required' => __('default.form.validation.name.required'),
  //     'type_id' => 'required|exists:horse_types,id',
  //     'race' => 'required|string',
  //     'birth_year' => 'required|numeric',
  //     'passport_type_id' => 'required|exists:horse_passports,id',
  //     'height' => 'required|numeric',
  //     'color' => 'required|string',
  //     'health' => 'required|string',
  //     'contact_number' => 'required|string',
  //     'father_name' => 'string',
  //     'mother_name' => 'string',
  //     'description' => 'required|string',
  //     'meta_title' => 'required|string',
  //     'meta_description' => 'required|string',
  //     'meta_keywords' => 'required|string'

  //   ];
  // }
}
