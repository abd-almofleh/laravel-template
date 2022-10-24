<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\GetListedHorsesRequest;
use App\Http\Requests\Api\Customer\OrderListedHorseRequest;
use App\Models\ListedHorse;
use App\Services\ListedHorsesService;
use Auth;

class ListedHorsesController extends Controller
{
  private $listedHorsesService;

  public function __construct(ListedHorsesService $listedHorsesService)
  {
    $this->listedHorsesService = $listedHorsesService;
  }

  public function index(GetListedHorsesRequest $request)
  {
    $filters = [];
    $filters['name'] = $request->input('name', false) ;
    $filters['sex'] = $request->input('sex', false) ;
    $filters['min_birth_year'] = $request->input('min_birth_year', false);
    $filters['max_birth_year'] = $request->input('max_birth_year', false);
    $filters['min_height'] = $request->input('min_height', false) ;
    $filters['max_height'] = $request->input('max_height', false);
    $filters['color'] = $request->input('color', false);
    $filters['type'] = $request->input('type', false);
    $filters['passport'] = $request->input('passport', false);

    $data = $this->listedHorsesService->get_listed_horses_list($filters);
    return $this->response('success', $data);
  }

  public function get_filter_options()
  {
    $options = $this->listedHorsesService->get_filter_options();
    return $this->response('success', $options);
  }

  public function order(OrderListedHorseRequest $request, ListedHorse $listedHorse)
  {
    $phone_number = $request->input('phone_number');
    $customer = Auth::user();
    $this->listedHorsesService->order_horse($listedHorse, $customer, $phone_number);
    return $this->response('success');
  }
}
