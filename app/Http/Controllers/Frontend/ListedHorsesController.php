<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Global\GetListedHorsesRequest;
use App\Models\ListedHorse;
use App\Services\ListedHorsesService;

class ListedHorsesController extends Controller
{
  private $listedHorsesService;

  public function __construct(ListedHorsesService $listedHorsesService)
  {
    $this->listedHorsesService = $listedHorsesService;
  }

  /**
   * It takes a request, get the filter option from it, and then passes the filters to the service layer
   *
   * @param GetListedHorsesRequest request The request object.
   *
   * @return \Illuminate\Contracts\View\View A view with the listed horses.
   */
  public function index(GetListedHorsesRequest $request): \Illuminate\Contracts\View\View
  {
    $filters = [];
    $filters['query'] = $request->input('query', false) ;
    $filters['gender'] = $request->input('gender', false) ;
    $filters['min_birth_year'] = $request->input('min_birth_year', false);
    $filters['max_birth_year'] = $request->input('max_birth_year', false);
    $filters['min_height'] = $request->input('min_height', false) ;
    $filters['max_height'] = $request->input('max_height', false);
    $filters['color'] = $request->input('color', false);
    $filters['type'] = $request->input('type', false);
    $filters['passport'] = $request->input('passport', false);
    $listedHorses = $this->listedHorsesService->get_listed_horses_list($filters);

    return view('frontend.listed-horses.index', compact('listedHorses'));
  }

  public function show(ListedHorse $listedHorse)
  {
    return view('frontend.listed-horses.show', compact('listedHorse'));
  }
}
