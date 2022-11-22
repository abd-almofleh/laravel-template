<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
    'category:id,name_ar,name_en',
    'author',
  ];

  protected $dates = [
    'created_at',
    'updated_at',
  ];

  protected $appends = [
    'photo',
  ];

  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];

  /**
   * When a new blog post is created, set the author_id to the current user's id.
   */
  protected static function boot()
  {
    parent::boot();

    CmsBlog::creating(function ($model) {
      $model->author_id = Auth::user()->id;
    });
  }

  /**
   * Get the route key for the model.
   *
   * @return string
   */
  public function getRouteKeyName()
  {
    switch(app()->getLocale()) {
      case 'en':
        return 'slug_en';
        break;
      case 'ar':
        return 'slug_ar';
        break;
      default:
        return 'slug_en';
    }
  }

    public function registerMediaConversions(Media $media = null): void
    {
      $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 50, 50)->performOnCollections('photos');
      $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 120, 120)->performOnCollections('photos');
    }

    // * Attributes
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

    public function getTitleAttribute(): string
    {
      return app()->getLocale() === 'en' ? $this->title_en : $this->title_ar;
    }

    public function getDescriptionAttribute(): string
    {
      return app()->getLocale() === 'en' ? $this->description_en : $this->description_ar;
    }

    public function getPageUrlAttribute(): string
    {
      return route('blogs.show', $this->slug);
    }

    public function getPrefAttribute(): string
    {
      $textOnly = strip_tags($this->description);
      $words = explode(' ', $textOnly);
      return implode(' ', array_splice($words, 0, 20)) . '...';
    }

    public function getSlugAttribute(): string
    {
      switch(app()->getLocale()) {
        case 'en':
          return $this->slug_en;
          break;
        case 'ar':
          return $this->slug_ar;
          break;
        default:
          return $this->slug_en;
      }
    }

    // * scopes
    public function scopeRecent(Builder $query, int $count = 5)
    {
      $query->latest('updated_at')->limit($count)->get();
    }

    // * Relations
    public function category()
    {
      return $this->belongsTo(CmsCategory::class, 'cms_category_id');
    }

    public function author()
    {
      return $this->belongsTo(User::class, 'author_id');
    }
}
