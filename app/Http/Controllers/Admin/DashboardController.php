<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function dashboard()
  {
    $user = User::get();
    return view('admin.dashboard', compact('user'));
  }
}
