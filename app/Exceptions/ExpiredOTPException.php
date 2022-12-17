<?php

namespace App\Exceptions;

use Exception;

class ExpiredOTPException extends Exception
{
  public function __construct(string $message = null)
  {
    $this->message = $message ?? __('default.errors.your_otp_has_been_expired');
  }

  /**
   * Render the exception into an HTTP response.
   *
   * @return \Illuminate\Http\Response
   */
  public function render()
  {
    abort(403, $this->message);
  }
}
