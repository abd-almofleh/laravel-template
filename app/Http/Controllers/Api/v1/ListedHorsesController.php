<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\GetListedHorsesRequest;
use App\Models\ListedHorse;

class ListedHorsesController extends Controller
{
  public function index(GetListedHorsesRequest $request)
  {
    $query = ListedHorse::query();

    if ($name = $request->input('name')) {
      $query->whereRaw('UPPER(`name`) LIKE ?', ['%' . strtoupper($name) . '%']);
    }

    if ($request->input('sex') !== null) {
      $sex = (int) $request->input('sex') ;
      $query->where('sex', $sex);
    }

    if ($request->input('min_birth_year') !== null && $request->input('max_birth_year') !== null) {
      $min_birth_year = $request->input('min_birth_year');
      $max_birth_year = $request->input('max_birth_year');
      $query->where('birth_year', '>=', $min_birth_year)->where('birth_year', '<=', $max_birth_year);
    }

    if ($request->input('min_height') !== null && $request->input('max_height') !== null) {
      $min_height = $request->input('min_height') ;
      $max_height = $request->input('max_height');
      $query->where('height', '>=', $min_height)->where('height', '<=', $max_height);
    }

    if ($color = $request->input('color')) {
      $query->whereRaw('UPPER(`color`) LIKE ?', ['%' . strtoupper($color) . '%']);
    }

    if ($type = $request->input('type')) {
      $query->where('type_id', $type);
    }
    if ($passport = $request->input('passport')) {
      $query->where('passport_type_id', $passport);
    }

    $data = $query->paginate();
    return $this->response('success', $data);
  }
}
