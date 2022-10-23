<?php

namespace App\Http\Requests\Admin\Horses\Passports;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHorsePassportRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('horsePassport-edit');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name_ar' => ['required', 'string', Rule::unique('horse_passports', 'name_ar')->ignore($this->passport->id)],
      'name_en' => ['required', 'string', Rule::unique('horse_passports', 'name_en')->ignore($this->passport->id)],
      'status'  => 'required|boolean',
    ];
  }

  public function messages()
  {
    return [
      'name_ar.required'   => __('default.form.validation.name.required'),
      'name_ar.unique'     => __('default.form.validation.name.unique'),
      'name_en.required'   => __('default.form.validation.name.required'),
      'name_en.unique'     => __('default.form.validation.name.unique'),
      'status.required'    => __('default.form.validation.status.required'),
    ];
  }
}
