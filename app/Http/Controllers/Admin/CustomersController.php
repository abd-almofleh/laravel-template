<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Exception;
use Illuminate\Validation\Rule;

class CustomersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
    $this->middleware('permission:customer.list,admin', ['only' => ['index', 'store']]);
    $this->middleware('permission:customer.create,admin', ['only' => ['create', 'store']]);
    $this->middleware('permission:customer.edit,admin', ['only' => ['edit', 'update']]);
    $this->middleware('permission:customer.delete,admin', ['only' => ['destroy']]);
    $this->middleware('permission:profile:index,admin', ['only' => ['profile', 'profile_update']]);

    $user_list = Permission::get()->filter(function ($item) {
      return $item->name == 'customer.list';
    })->first();
    $user_create = Permission::get()->filter(function ($item) {
      return $item->name == 'customer.create';
    })->first();
    $user_edit = Permission::get()->filter(function ($item) {
      return $item->name == 'customer.edit';
    })->first();
    $user_delete = Permission::get()->filter(function ($item) {
      return $item->name == 'customer.delete';
    })->first();
    $profile_index = Permission::get()->filter(function ($item) {
      return $item->name == 'profile:index';
    })->first();

    if ($user_list == null) {
      Permission::create(['name'=>'customer.list', 'guard_name' => 'admin']);
    }
    if ($user_create == null) {
      Permission::create(['name'=>'customer.create', 'guard_name' => 'admin']);
    }
    if ($user_edit == null) {
      Permission::create(['name'=>'customer.edit', 'guard_name' => 'admin']);
    }
    if ($user_delete == null) {
      Permission::create(['name'=>'customer.delete', 'guard_name' => 'admin']);
    }
    if ($profile_index == null) {
      Permission::create(['name'=>'profile:index', 'guard_name' => 'admin']);
    }
  }

  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Customer::get();
      return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $edit = '<a href="' . route('admin.customers.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        ' . __('default.form.edit-button') . '
                                </a>';
            $delete = '<button class="custom-delete-btn remove-customer" data-id="' . $row->id . '" data-action="' . route('admin.customers.destroy', $row->id) . '">
										<i class="fe fe-trash"></i>
		                                ' . __('default.form.delete-button') . '
									</button>';
            $action = $edit . ' ' . $delete;
            return $action;
          })

          ->rawColumns(['action'])
          ->escapeColumns([])
          ->make(true);
    }
    return view('admin.customers.index');
  }

  public function edit(Customer $customer)
  {
    return view('admin.customers.edit', compact('customer'));
  }

  public function update(Request $request, Customer $customer)
  {
    $rules = [
      'name'           => 'required|string',
      'email'          => ['required', 'string', 'email', Rule::unique('customers', 'email')->ignore($customer->id)],
      'birth_date'     => 'required|date_format:Y-m-d|date',
      'phone_number'   => 'required|string|regex:/^(9715)\d{8}$/i',
    ];

    $this->validate($request, $rules);
    $input = $request->only(['name', 'email', 'birth_date', 'phone_number']);
    if ($request->phone_number != $customer->phone_number) {
      $input['phone_verified_at'] = null;
    }
    try {
      $customer->update($input);
      Toastr::success(__('user.message.update.success'));
      return redirect()->route('admin.customers.index');
    } catch (Exception $e) {
      Toastr::error(__('user.message.update.error'));
      return redirect()->route('admin.customers.index');
    }
  }

  public function destroy(Customer $customer)
  {
    try {
      $customer->delete();
      return back()->with(Toastr::success(__('user.message.destroy.success')));
    } catch (Exception $e) {
      $error_msg = Toastr::error(__('user.message.destroy.error'));
      return redirect()->route('users.index')->with($error_msg);
    }
  }
}
