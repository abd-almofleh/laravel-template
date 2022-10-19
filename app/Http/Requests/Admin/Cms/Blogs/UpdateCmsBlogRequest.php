<?php

namespace App\Http\Requests\Admin\Cms\Blogs;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCmsBlogRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('cms.blog:edit');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    if ($this->input('status', $this->blog->status) == 1) {
      return [
        'title_en'            => 'required|string',
        'title_ar'            => 'required|string',
        'slug'                => ['required', 'string', Rule::unique('cms_blogs', 'slug')->ignore($this->blog->id)],
        'cms_category_id'     => 'required|exists:cms_categories,id',
        'description_en'      => 'required|string',
        'description_ar'      => 'required|string',
        'meta_title_en'       => 'required|string',
        'meta_title_ar'       => 'required|string',
        'meta_description_en' => 'required|string',
        'meta_description_ar' => 'required|string',
        'meta_keywords_en'    => 'required|string',
        'meta_keywords_ar'    => 'required|string',
        'status'              => 'required|boolean',
        'photo'               => 'required|string',
      ];
    } else {
      return [
        'title_en'                   => 'nullable|string',
        'title_ar'                   => 'nullable|string',
        'slug'                       => ['nullable', 'string', Rule::unique('cms_blogs', 'slug')->ignore($this->blog->id)],
        'cms_category_id'            => 'nullable|exists:cms_categories,id',
        'description_en'             => 'nullable|string',
        'description_ar'             => 'nullable|string',
        'meta_title_en'              => 'nullable|string',
        'meta_title_ar'              => 'nullable|string',
        'meta_description_en'        => 'nullable|string',
        'meta_description_ar'        => 'nullable|string',
        'meta_keywords_en'           => 'nullable|string',
        'meta_keywords_ar'           => 'nullable|string',
        'status'                     => 'boolean',
        'photo'                      => 'nullable|string',
      ];
    }
  }

  // public function messages()
  // {
  //   return [
  //     'name.required'    		       => __('default.form.validation.name.required'),
  //     'slug.required'    	        => __('default.form.validation.slug.required'),
  //     'slug.unique'    		         => __('default.form.validation.slug.unique'),
  //     'cms_category_id.required'  => __('default.form.validation.category.required'),
  //     'description.required'      => __('default.form.validation.description.required'),
  //     'meta_title.required'       => __('default.form.validation.meta_title.required'),
  //     'meta_description.required' => __('default.form.validation.meta_description.required'),
  //     'meta_keywords.required'    => __('default.form.validation.meta_keywords.required'),
  //     'status.required'    	      => __('default.form.validation.status.required'),
  //   ];
  // }
}
