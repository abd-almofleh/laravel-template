<?php

namespace App\Exceptions;

use Exception;

class WrongOTPException extends Exception
{
  public function __construct(string $message = null)
  {
    $this->message = $message ?? __('default.errors.your_otp_is_not_correct');
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
