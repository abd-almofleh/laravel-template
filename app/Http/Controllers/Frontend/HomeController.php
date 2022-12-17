<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('web');
  }

  public function index()
  {
    return view('frontend.index');
  }
}
