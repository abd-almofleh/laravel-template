<?php

namespace App\Http\Requests\Api\Customer;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderListedHorseRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::user()->can('listedHorse:order', 'api');
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'phone_number' => 'required|string|regex:/^(9715)\d{8}$/i',
    ];
  }
}
