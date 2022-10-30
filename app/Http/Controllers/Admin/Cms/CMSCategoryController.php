<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cms\Categories\StoreCmsCategoryRequest;
use App\Http\Requests\Admin\Cms\Categories\UpdateCmsCategoryRequest;
use App\Http\Requests\Admin\Cms\Categories\UpdateCmsCategoryStatusRequest;
use App\Models\CmsCategory;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

/* It's a controller class that has methods to create and update categories. */
class CMSCategoryController extends Controller
{
  /**
   * The above function is a constructor function that is used to define the middleware for the
   * controller
   */
  public function __construct()
  {
    $this->middleware('auth:admin');
    $this->middleware('permission:cms.category:list,admin', ['only' => ['index']]);
    $this->middleware('permission:cms.category:create,admin', ['only' => ['create', 'store']]);
    $this->middleware('permission:cms.category:edit,admin', ['only' => ['edit', 'update', 'update_status']]);
  }

  /**
   * It returns the data in the form of a table.
   *
   * @param Request request The request object.
   *
   * @return The view is being returned.
   */
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

  /**
   * It returns a view called `admin.cms.categories.create`
   *
   * @return A view.
   */
  public function create()
  {
    return view('admin.cms.categories.create');
  }

  /**
   * It creates a new category and redirects to the index page.
   *
   * @param StoreCmsCategoryRequest request The request object.
   *
   * @return The return value of the last statement in the try block.
   */
  public function store(StoreCmsCategoryRequest $request)
  {
    $input = $request->validated();

    try {
      CmsCategory::create($input);

      Toastr::success(__('cms.category.message.store.success'));
      return redirect()->route('cms.categories.index');
    } catch (Exception $e) {
      Toastr::error(__('cms.category.message.store.error'));
      return redirect()->route('cms.categories.index');
    }
  }

  /**
   * It returns a view called `admin.cms.categories.edit` and passes the `category` variable to the view
   *
   * @param CmsCategory category The model instance passed to the controller from the route
   *
   * @return The view is being returned.
   */
  public function edit(CmsCategory $category)
  {
    return view('admin.cms.categories.edit', compact('category'));
  }

  /**
   * It updates the category with the given input, and then redirects to the index page.
   *
   * @param UpdateCmsCategoryRequest request The request object.
   * @param CmsCategory category The model instance that should be updated.
   *
   * @return The return value of the method is the response that will be sent back to the user's browser.
   */
  public function update(UpdateCmsCategoryRequest $request, CmsCategory $category)
  {
    $input = $request->validated();

    try {
      $category->update($input);
      Toastr::success(__('cms.category.message.update.success'));
      return redirect()->route('cms.categories.index');
    } catch (Exception $e) {
      Toastr::error(__('cms.category.message.update.error'));
      return redirect()->route('cms.categories.index');
    }
  }

  /**
   * It updates the status of a category
   *
   * @param UpdateCmsCategoryStatusRequest request The request object.
   * @param CmsCategory category The model instance that will be updated.
   *
   * @return The response is being returned as a JSON object.
   */
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
