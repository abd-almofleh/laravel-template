<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CmsBlog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $blogs = CmsBlog::with('category')->whereHas('category', function (Builder $query) use ($request) {
      $category = $request->get('category');
      $query->when($category !== null, fn (Builder $q) => $q->category($category));
    })->paginate();
    return view('frontend.blogs.index', compact('blogs'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int                       $id
   * @return \Illuminate\Http\Response
   */
  public function show(CmsBlog $blog)
  {
    return view('frontend.blogs.show', compact('blog'));
  }
}
