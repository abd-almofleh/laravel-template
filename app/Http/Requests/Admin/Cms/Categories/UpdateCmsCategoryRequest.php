<?php

namespace App\Http\Requests\Admin\Cms\Categories;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCmsCategoryRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('cms.category:edit');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'   => ['required', 'string', Rule::unique('horse_types', 'name')->ignore($this->category->id)],
      'status' => 'required|boolean',
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
