<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Global\StoreSuggestionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
    dd($request);
    $suggestion = $request->suggestion;
    $email = $request->email;
    $this->handel($suggestion, $email);
    return $this->GetResponse($request->expectsJson());
  }

  private function handel(string $suggestion, ?string $email = ''): void
  {
  }

  private function GetResponse(bool $isJson = false): JsonResponse | RedirectResponse
  {
    $message = 'Your suggestion has been received successfully.';
    error_log($isJson);
    if ($isJson) {
      return $this->response($message, null, 201);
    }
    toastr()->success($message);
    // return redirect()->back();
  }
}
