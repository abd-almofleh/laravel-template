<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;

class Controller extends BaseController
{
  use AuthorizesRequests;
  use DispatchesJobs;
  use ValidatesRequests;

  public function response($message, $data = null, $code = 200)
  {
    return Response::json(array_filter([
      'message' => $message,
      'data'    => $data,
    ]), $code);
  }
}
