<?php

namespace App\Exceptions;

use Exception;

class PhoneNumberNotVerifiedException extends Exception
{
  public string $phoneNumber;

  public function __construct(string $phoneNumber, string $message = null)
  {
    $this->message = $message ?? __('default.errors.phone_number_is_not_verified');
    $this->phoneNumber = $phoneNumber;
  }

  /**
   * Render the exception into an HTTP response.
   *
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    abort(response()->json(['message' => $this->message, 'data' => ['phone_number' => $this->phoneNumber]], 401));
  }
}
