<?php

namespace App\Exceptions;

use Exception;

class PhoneAlreadyVerifiedException extends Exception
{
  public function __construct(string $message = null)
  {
    $this->message = $message ?? __('default.errors.phone_number_is_already_verified');
  }

  /**
   * Render the exception into an HTTP response.
   *
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    abort(401, $this->message);
  }
}
