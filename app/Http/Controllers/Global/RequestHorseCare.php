<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Global\RequestHorseCareRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RequestHorseCare extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  App\Http\Requests\Global\StoreSuggestionRequest $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(RequestHorseCareRequest $request)
  {
    $horse_type = $request->horse_type;
    $sickness = $request->sickness;
    $description = $request->description;
    $this->handel($horse_type, $sickness, $description);
    return $this->GetResponse($request->expectsJson());
  }

  private function handel(string $horse_type, string $sickness, string $description): void
  {
  }

  private function GetResponse(bool $isJson = false): JsonResponse | RedirectResponse
  {
    return $isJson ? $this->response('Your request has been received successfully. One of our doctors will contact you as soon as possible.', null, 201) : redirect()->route('home');
  }
}
