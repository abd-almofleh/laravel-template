<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CmsBlog;
use App\Models\HorseType;
use App\Models\ListedHorse;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('web');
  }

  public function index()
  {
    $types = HorseType::all();
    $listedHorses = ListedHorse::latest()->limit(6)->get();
    $blogs = CmsBlog::latest()->limit(3)->get();

    return view('frontend.index', compact('types', 'listedHorses', 'blogs'));
  }

  public function aboutUs()
  {
    return view('frontend.about-us');
  }

  public function contactUs()
  {
    return view('frontend.contact-us');
  }
}
