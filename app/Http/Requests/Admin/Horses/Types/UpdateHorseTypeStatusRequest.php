<?php

namespace App\Http\Requests\Admin\Horses\Types;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class updateHorseTypeStatusRequest extends FormRequest
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
      'status' => 'required|boolean',
    ];
  }

  public function messages()
  {
    return [
      'status.required' => __('default.form.validation.status.required'),
    ];
  }
}
