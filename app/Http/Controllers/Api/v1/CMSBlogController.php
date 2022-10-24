<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\GetCMSBlogsRequest;
use App\Models\CmsBlog;
use App\Models\CmsCategory;

class CMSBlogController extends Controller
{
  public function index(GetCMSBlogsRequest $request)
  {
    $filters = [];
    $query = CmsBlog::query();
    $filters['query'] = $request->input('query', false) ;
    $filters['category_id'] = $request->input('category', false) ;
    if ($filters['query'] !== false) {
      $query->whereRaw('UPPER(`description_ar`) LIKE ?', ['%' . strtoupper($filters['query']) . '%']);
      $query->orWhereRaw('UPPER(`description_en`) LIKE ?', ['%' . strtoupper($filters['query']) . '%']);
      $query->orWhereRaw('UPPER(`title_en`) LIKE ?', ['%' . strtoupper($filters['query']) . '%']);
      $query->orWhereRaw('UPPER(`title_ar`) LIKE ?', ['%' . strtoupper($filters['query']) . '%']);
    }
    if ($filters['category_id'] !== false) {
      $query->orWhere('cms_category_id', $filters['category_id']);
    }

    $data = $query->paginate();
    return $this->response('success', $data);
  }

  public function get_filter_options()
  {
    $options = [];
    $options['blogs_categories'] = CmsCategory::select(['id', 'name_en', 'name_ar'])->active()->get();
    return $this->response('success', $options);
  }
}
