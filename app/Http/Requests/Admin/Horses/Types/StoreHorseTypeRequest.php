<?php

namespace App\Http\Requests\Admin\Horses\Types;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreHorseTypeRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('horseType-create');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name_en' => 'required|string|unique:horse_types,name_ar',
      'name_ar' => 'required|string|unique:horse_types,name_en',
      'status'  => 'required|boolean',
      'photo'   => 'required|string',
    ];
  }

  public function messages()
  {
    return [
      'name.required'   => __('default.form.validation.name.required'),
      'name.unique'     => __('default.form.validation.name.unique'),
      'status.required' => __('default.form.validation.status.required'),
    ];
  }
}
