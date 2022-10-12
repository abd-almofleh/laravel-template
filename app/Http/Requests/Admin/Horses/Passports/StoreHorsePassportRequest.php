<?php

namespace App\Http\Requests\Admin\Horses\Passports;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreHorsePassportRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('horsePassport-create');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'required|string|unique:horse_passports,name',
      'status' => 'required|boolean',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => __('default.form.validation.name.required'),
      'name.unique' => __('default.form.validation.name.unique'),
      'status.required' => __('default.form.validation.status.required'),
    ];
  }
}
