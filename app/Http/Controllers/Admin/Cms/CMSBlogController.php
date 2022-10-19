<?php

namespace App\Http\Controllers\Admin\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\Cms\Blogs\StoreCmsBlogRequest;
use App\Http\Requests\Admin\Cms\Blogs\UpdateCmsBlogRequest;
use App\Models\CmsBlog;
use App\Models\CmsCategory;
use Auth;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class CMSBlogController extends Controller
{
  use MediaUploadingTrait;

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('permission:cms.blog:list', ['only' => ['index']]);
    $this->middleware('permission:cms.blog:create', ['only' => ['create', 'store']]);
    $this->middleware('permission:cms.blog:edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:cms.blog:delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = CmsBlog::get();
      return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            if (Auth::user()->can('cms.blog:show')) {
              $view = '<a href="' . route('cms.blogs.show', $row->id) . '" class="custom-view-btn mr-1">
                                <i class="fe fe-eye"></i> ' . __('default.form.view-button') . '
                            </a>';
            } else {
              $edit = '';
            }
            if (Auth::user()->can('cms.blog:edit')) {
              $edit = '<a href="' . route('cms.blogs.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> ' . __('default.table.edit') . '
                                </a>';
            } else {
              $edit = '';
            }

            if (Auth::user()->can('cms.blog:delete')) {
              $delete = '<button class="custom-delete-btn remove-cmspage" data-id="' . $row->id . '" data-action="' . route('cms.blogs.destroy', $row->id) . '">
										<i class="fe fe-trash"></i> ' . __('default.table.delete') . '
									</button>';
            } else {
              $delete = '';
            }
            $action = $view . ' ' . $edit . ' ' . $delete;
            return $action;
          })
          ->addColumn('categoryName', function ($row) {
            return $row->category !== null ? $row->category->name : '<span style="color: red;">' . __('default.table.no_category') . '</span>';
          })
          ->addColumn('status', function ($row) {
            return $row->status == 1 ? __('cms.blogs.status.published') : __('cms.blogs.status.draft');
          })
          ->rawColumns(['action', 'categoryName'])
          ->make(true);
    }
    return view('admin.cms.blogs.index');
  }

  public function create()
  {
    $cms_categories = CmsCategory::where('status', 1)->get();
    return view('admin.cms.blogs.create', compact('cms_categories'));
  }

  public function store(StoreCmsBlogRequest $request)
  {
    $input = $request->validated();

    try {
      $product = CmsBlog::create($input);
      if ($request->input('photo', false)) {
        $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photos');
      }

      Toastr::success(__('cms.blogs.message.store.success'));
      return redirect()->route('cms.blogs.index');
    } catch (Exception $e) {
      Toastr::error(__('cms.blogs.message.store.error'));
      return redirect()->route('cms.blogs.index');
    }
  }

  public function edit(CmsBlog $blog)
  {
    $cms_categories = CmsCategory::get();
    return view('admin.cms.blogs.edit', compact('blog', 'cms_categories'));
  }

  public function update(UpdateCmsBlogRequest $request, CmsBlog $blog)
  {
    $input = $request->validated();
    // dump($blog->toArray());
    // dd($input);

    try {
      $blog->update($input);

      if ($request->input('photo', false)) {
        if (!$blog->photo || $request->input('photo') !== $blog->photo->file_name) {
          if ($blog->photo) {
            $blog->photo->delete();
          }
          $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photos');
        }
      } elseif ($blog->photo) {
        $blog->photo->delete();
      }

      Toastr::success(__('cms.blogs.message.update.success'));
      return redirect()->route('cms.blogs.index');
    } catch (Exception $e) {
      Toastr::error(__('cms.blogs.message.update.error'));
      return redirect()->route('cms.blogs.index');
    }
  }

  public function destroy(CmsBlog $blog)
  {
    try {
      $blog->delete();
      Toastr::error(__('cms.blogs.message.destroy.success'));
      return redirect()->route('cms.blogs.index');
    } catch (Exception $e) {
      Toastr::error(__('cms.blogs.message.destroy.error'));
      return redirect()->route('cms.blogs.index');
    }
  }

  public function status_update(Request $request)
  {
  }
}
