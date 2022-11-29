<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Global\StoreSuggestionRequest;
use Illuminate\Http\Request;

class StoreSuggestion extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  App\Http\Requests\Global\StoreSuggestionRequest $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(StoreSuggestionRequest $request)
  {
    $suggestion = $request->suggestion;
    $email = $request->email;
    $this->handel($suggestion, $email);
    return $this->GetResponse($request->expectsJson());
  }

  private function handel(string $suggestion, ?string $email = '')
  {
  }

  private function GetResponse(bool $isJson = false)
  {
    return $isJson ? $this->response('Your suggestion has been received successfully.', null, 201) : redirect()->route('home');
  }
}
