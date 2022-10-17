<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class ApiResponse
 *
 * @package App\Http\Middleware
 */
class ApiResponse
{
  /**
   * @var ResponseFactory
   */
  protected $factory;

  /**
   * ApiResponse constructor.
   *
   * @param ResponseFactory $factory
   */
  public function __construct(ResponseFactory $factory)
  {
    $this->factory = $factory;
  }

  /**
   * @param $request
   * @param Closure $next
   *
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    // force JSON response
    $request->headers->set('Accept', 'application/json');
    $response = $next($request);

    return $this->factory->json(
      $response->getOriginalContent(),
      $response->status(),
      $response->headers->all()
    );
  }
}
