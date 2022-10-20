<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CmsBlog extends Model implements HasMedia
{
  use  Loggable;
  use InteractsWithMedia;

  protected static function boot()
  {
    parent::boot();

    CmsBlog::creating(function ($model) {
      $model->author_id = Auth::user()->id;
    });
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title_ar',
    'title_en',
    'slug_ar',
    'slug_en',
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
    'author',
  ];

  protected $dates = [
    'created_at',
    'updated_at',
  ];

  protected $appends = [
    'photo',
  ];

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 50, 50)->performOnCollections('photos');
    $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 120, 120)->performOnCollections('photos');
  }

  public function getPhotoAttribute(): ?Media
  {
    $file = $this->getMedia('photos')->last();
    if ($file) {
      $file->url = $file->getUrl();
      $file->thumbnail = $file->getFullUrl('thumb');
      $file->preview = $file->getFullUrl('preview');
    }
    return $file;
  }

  public function category()
  {
    return $this->belongsTo(CmsCategory::class, 'cms_category_id');
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'author_id');
  }
  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];
}
