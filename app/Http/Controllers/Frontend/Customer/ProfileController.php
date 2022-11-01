<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\Customer\UpdateCustomerProfileRequest;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:customer_frontend');
  }

  public function index()
  {
    return view('frontend.customer.profile');
  }

  public function update(UpdateCustomerProfileRequest $request)
  {
    $data = $request->validated();
    
    Auth::user()->update($data);
    Toastr::success(__('frontend/default.form.messages.update.success'));

    return redirect()->back();
  }
}
