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
      'name_en'   => ['required', 'string', Rule::unique('cms_categories', 'name_en')->ignore($this->category->id)],
      'name_ar'   => ['required', 'string', Rule::unique('cms_categories', 'name_ar')->ignore($this->category->id)],
      'status'    => 'required|boolean',
    ];
  }

  public function messages()
  {
    return [
      'name_en.required'   => __('default.form.validation.name.required'),
      'name_en.unique'     => __('default.form.validation.name.unique'),
      'name_ar.required'   => __('default.form.validation.name.required'),
      'name_ar.unique'     => __('default.form.validation.name.unique'),
      'status.required' => __('default.form.validation.status.required'),
    ];
  }
}
