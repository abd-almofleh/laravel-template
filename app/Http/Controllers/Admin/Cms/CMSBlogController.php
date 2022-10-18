<?php

namespace App\Http\Controllers\Admin\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CmsBlog;
use App\Models\CmsCategory;
use App\Models\CmsPage;
use Auth;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Exception;

class CMSBlogController extends Controller
{
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

          ->addColumn('status', function ($row) {
            return $row->status == 1 ? __('cms.blogs.status.published') : __('cms.blogs.status.draft');
          })
          ->rawColumns(['action'])
          ->make(true);
    }
    return view('admin.cms.blogs.index');
  }

  public function create()
  {
    $cmscategories = CmsCategory::where('status', 1)->get();
    return view('admin.cmspages.create', compact('cmscategories'));
  }

  public function store(Request $request)
  {
    $rules = [
      'title' 		          => 'required|string',
      'slug' 		           => 'required|string|unique:cms_pages,slug',
      'cms_category_id' 	 => 'required|string',
      'description' 	     => 'required|string',
      'meta_title' 	      => 'required|string',
      'meta_description' 	=> 'required|string',
      'meta_keywords' 	   => 'required|string',
      'status' 		         => 'required|numeric',
    ];

    $messages = [
      'name.required'    		       => __('default.form.validation.name.required'),
      'slug.required'    	        => __('default.form.validation.slug.required'),
      'slug.unique'    		         => __('default.form.validation.slug.unique'),
      'cms_category_id.required'  => __('default.form.validation.category.required'),
      'description.required'      => __('default.form.validation.description.required'),
      'meta_title.required'       => __('default.form.validation.meta_title.required'),
      'meta_description.required' => __('default.form.validation.meta_description.required'),
      'meta_keywords.required'    => __('default.form.validation.meta_keywords.required'),
      'status.required'    	      => __('default.form.validation.status.required'),
    ];

    $this->validate($request, $rules, $messages);
    $input = request()->all();

    try {
      $cmspage = CmsPage::create($input);
      Toastr::success(__('cmspages.message.store.success'));
      return redirect()->route('cmspages.index');
    } catch (Exception $e) {
      Toastr::error(__('cmspages.message.store.error'));
      return redirect()->route('cmspages.index');
    }
  }

  public function edit($id)
  {
    $cmspage = CmsPage::find($id);
    $cmscategories = CmsCategory::get();
    return view('admin.cmspages.edit', compact('cmspage', 'cmscategories'));
  }

  public function update(Request $request, $id)
  {
    $rules = [
      'title' 		          => 'required|string',
      'slug' 		           => 'string|unique:cms_pages,slug,' . $id,
      'cms_category_id' 	 => 'required|string',
      'description' 	     => 'required|string',
      'meta_title' 	      => 'required|string',
      'meta_description' 	=> 'required|string',
      'meta_keywords' 	   => 'required|string',
      'status' 		         => 'required|numeric',
    ];

    $messages = [
      'name.required'    		       => __('default.form.validation.name.required'),
      'slug.required'    	        => __('default.form.validation.slug.required'),
      'slug.unique'    		         => __('default.form.validation.slug.unique'),
      'cms_category_id.required'  => __('default.form.validation.category.required'),
      'description.required'      => __('default.form.validation.description.required'),
      'meta_title.required'       => __('default.form.validation.meta_title.required'),
      'meta_description.required' => __('default.form.validation.meta_description.required'),
      'meta_keywords.required'    => __('default.form.validation.meta_keywords.required'),
      'status.required'    	      => __('default.form.validation.status.required'),
    ];

    $this->validate($request, $rules, $messages);
    $input = $request->all();
    $cmspage = CmsPage::find($id);

    try {
      $cmspage->update($input);
      Toastr::success(__('cms.message.update.success'));
      return redirect()->route('cmspages.index');
    } catch (Exception $e) {
      Toastr::error(__('cms.message.update.error'));
      return redirect()->route('cmspages.index');
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
    $cmspage = CmsPage::find($request->id)->update(['status' => $request->status]);

    if ($request->status == 1) {
      return response()->json(['message' => 'Status activated successfully.']);
    } else {
      return response()->json(['message' => 'Status deactivated successfully.']);
    }
  }
}
