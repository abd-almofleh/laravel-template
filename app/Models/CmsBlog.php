<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CmsBlog extends Model implements HasMedia
{
  use  Loggable;
  use InteractsWithMedia;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title_ar',
    'title_en',
    'slug',
    'description_ar',
    'description_en',
    'cms_category_id',
    'status',
    'meta_title_ar',
    'meta_title_en',
    'meta_description_ar',
    'meta_description_en',
    'meta_keywords_ar',
    'meta_keywords_en',

  ];

  protected $with = [
    'category:id,name',
  ];

  public function category()
  {
    return $this->belongsTo(CmsCategory::class, 'cms_category_id');
  }
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];
}
