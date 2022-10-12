<?php

namespace App\Http\Requests\Admin\Horses\Types;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateHorseTypeRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('horseType-edit');
    ;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => ['required', 'string', Rule::unique('horse_types', 'name')->ignore($this->type->id)],
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
