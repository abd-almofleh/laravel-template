<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cms\Categories\StoreCmsCategoryRequest;
use App\Http\Requests\Admin\Cms\Categories\UpdateCmsCategoryStatusRequest;
use App\Models\CmsCategory;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class CMSCategoryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('permission:cms.category:list', ['only' => ['index']]);
    $this->middleware('permission:cms.category:create', ['only' => ['create', 'store']]);
    $this->middleware('permission:cms.category:edit', ['only' => ['edit', 'update', 'update_status']]);
  }

  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = CmsCategory::get();
      return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            if (Auth::user()->can('cms.category:edit')) {
              $edit = '<a href="' . route('cms.categories.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> ' . __('default.form.edit-button') . '
                                </a>';
            } else {
              $edit = '';
            }
            return $edit;
          })

          ->addColumn('status', function ($row) {
            if ($row->status == 1) {
              $current_status = 'Checked';
            } else {
              $current_status = '';
            }

            $status = "<input type='checkbox' id='status_$row->id' id='category-$row->id' class='check' onclick='changeCmsCategoryStatus(event.target, $row->id);' " . $current_status . ">
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
            return $status;
          })

          ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
          ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
          ->escapeColumns([])
          ->make(true);
    }
    return view('admin.cms.categories.index');
  }

  public function create()
  {
    return view('admin.cms.categories.create');
  }

  public function store(StoreCmsCategoryRequest $request)
  {
    $input = $request->validated();

    try {
      $x = CmsCategory::create($input);

      Toastr::success(__('cms.category.message.store.success'));
      return redirect()->route('cms.categories.index');
    } catch (Exception $e) {
      Toastr::error(__('cms.category.message.store.error'));
      return redirect()->route('cms.categories.index');
    }
  }

  public function edit($id)
  {
    $cmscategory = CmsCategory::find($id);
    return view('admin.cmspages.cmscategories.edit', compact('cmscategory'));
  }

  public function update(Request $request, $id)
  {
    $rules = [
      'name'   => 'required|string|unique:cms_categories,name,' . $id,
      'slug'   => 'required|string|unique:cms_categories,slug,' . $id,
      'status' => 'required|numeric',
    ];

    $messages = [
      'name.required'   => __('default.form.validation.name.required'),
      'name.unique'     => __('default.form.validation.name.unique'),
      'slug.required'   => __('default.form.validation.slug.required'),
      'slug.unique'     => __('default.form.validation.slug.unique'),
      'status.required' => __('default.form.validation.status.required'),
    ];

    $this->validate($request, $rules, $messages);
    $input = $request->all();
    $cmscategory = CmsCategory::find($id);

    try {
      $cmscategory->update($input);
      Toastr::success(__('cmscategory.message.update.success'));
      return redirect()->route('cmscategories.index');
    } catch (Exception $e) {
      Toastr::error(__('cmscategory.message.update.error'));
      return redirect()->route('cmscategories.index');
    }
  }

  public function update_status(UpdateCmsCategoryStatusRequest $request, CmsCategory $category)
  {
    if (!$category) {
      return response()->json(['status' => 'failed', 'message' => __('cms.category.message.update.error')]);
    }
    $input = $request->validated();
    try {
      $category->update($input);
      return response()->json(['status' => 'success', 'message' => __('cms.category.message.update.success')]);
    } catch (Exception $e) {
      return response()->json(['status' => 'failed', 'message' => __('cms.category.message.update.error')]);
    }
  }
}
