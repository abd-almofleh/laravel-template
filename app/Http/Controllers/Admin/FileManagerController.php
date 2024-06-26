<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

class FileManagerController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
    $this->middleware('permission:file-manager,admin', ['only' => ['index']]);

    $file_manager = Permission::get()->filter(function ($item) {
      return $item->name == 'file-manager';
    })->first();

    if ($file_manager == null) {
      Permission::create(['name'=>'file-manager']);
    }
  }

  public function index(Request $request)
  {
    if (Gate::check('file-manager')) {
      return view('admin.file-manager.index');
    } else {
      return 403;
    }
  }
}
