<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CmsBlog extends Model implements HasMedia
{
  use Loggable;
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

  /* It's telling Laravel to eager load the `category`, `author`, and `media` relationships. */
  protected $with = [
    'category:id,name_ar,name_en',
    'author',
    'media',
  ];

  /* It's telling Laravel that the `created_at` and `updated_at` fields are of type `datetime` */
  protected $dates = [
    'created_at',
    'updated_at',
  ];

  /* It's telling Laravel that the `photo` attribute should be appended to the model's JSON
  representation. */
  protected $appends = [
    'slug',
    'title',
    'description',
    'photo',
    'media',
    'pref',
  ];

  /* It's telling Laravel to hide these attributes when the model is converted to JSON or array. */
  protected $hidden = [
    'meta_title_ar',
    'meta_title_en',
    'meta_description_ar',
    'meta_description_en',
    'meta_keywords_ar',
    'meta_keywords_en',
    'author_id',
    'created_at',
    'updated_at',
    'status',
    'cms_category_id',
    'media',
    'id',
    'title_ar',
    'title_en',
    'description_ar',
    'description_en',
    'slug_ar',
    'slug_en',
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
    $locale = request()->header('HTTP_ACCEPT_LANGUAGE', request()->session()->get('locale', app()->getLocale()));
    switch($locale) {
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

  /**
   * > This function will create two new image conversions for the `photos` collection. The first
   * conversion will be called `thumb` and will be a 50x50px crop. The second conversion will be called
   * `preview` and will be a 120x120px crop
   *
   * @param Media media The media instance to register the conversion for.
   */
  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 50, 50)->performOnCollections('photos');
    $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 120, 120)->performOnCollections('photos');
  }

  /**
   * * -----------------------------------------------------------------
   * * Attributes
   * * -----------------------------------------------------------------
   */

  /**
   * It returns an array of objects that contain the url, fullUrl, thumbnail, and preview of each photo
   *
   * @return array An array of objects.
   */
  public function getPhotoAttribute(): ?object
  {
    $file = $this->getMedia('photos')->first();
    if ($file) {
      $file->url = $file->getUrl();
      $file->fullUrl = $file->getFullUrl();
      $file->thumbnail = $file->getFullUrl('thumb');
      $file->preview = $file->getFullUrl('preview');
    }

    return $file;
  }

  /**
   * If the current locale is English, return the English title, otherwise return the Arabic title
   *
   * @return string The title attribute is being returned.
   */
  public function getTitleAttribute(): string
  {
    switch(app()->getLocale()) {
      case 'en':
        return $this->title_en ?? '';
      case 'ar':
        return $this->title_ar ?? '';
      default:
        return $this->title_ar ?? '';
    }
  }

  /**
   * > If the current locale is English, return the English description, otherwise return the Arabic
   * description
   *
   * @return string The description attribute is being returned.
   */
  public function getDescriptionAttribute(): string
  {
    switch(app()->getLocale()) {
      case 'en':
        return $this->description_en ?? '';
      case 'ar':
        return $this->description_ar ?? '';
      default:
        return $this->description_ar ?? '';
    }
  }

  /**
   * > This function returns the URL of the blog post
   *
   * @return string The route to the blog post.
   */
  public function getPageUrlAttribute(): string
  {
    return route('blogs.show', $this->slug);
  }

  /**
   * It takes the description of the post, strips out all the HTML tags, splits the text into an array of
   * words, and then returns the first 20 words joined back together with spaces
   *
   * @return string The first 20 words of the description.
   */
  public function getPrefAttribute(): string
  {
    $textOnly = strip_tags($this->description);
    $words = explode(' ', $textOnly);
    return implode(' ', array_splice($words, 0, 20)) . '...';
  }

  /**
   * If the locale is English, return the English slug, if it's Arabic, return the Arabic slug, otherwise
   * return the English slug
   *
   * @return string The slug attribute is being returned.
   */
  public function getSlugAttribute(): string
  {
    switch(app()->getLocale()) {
      case 'en':
        return $this->slug_en ?? '';
        break;
      case 'ar':
        return $this->slug_ar ?? '';
        break;
      default:
        return $this->slug_ar ?? '';
    }
  }
  //* -------------------------------------------------------------------------- */
  //*                                   Scopes                                   */
  //* -------------------------------------------------------------------------- */

  /**
   * It returns a query builder that filters the results to only include records that have a non-empty
   * slug in the current language
   *
   * @param Builder query The query builder instance.
   *
   * @return Builder A query builder object.
   */
  public function scopeWithLanguage(Builder $query): Builder
  {
    switch(app()->getLocale()) {
      case 'en':
        return $query->where(function ($q) {
          $q->whereNotNull('slug_en')->where('slug_en', '<>', '');
        });
      case 'ar':
        return $query->where(function ($q) {
          $q->whereNotNull('slug_ar')->where('slug_ar', '<>', '');
        });
      default:
        return $query->where(function ($q) {
          $q->whereNotNull('slug_ar')->where('slug_ar', '<>', '');
        });
    }
  }

  /**
   * * -----------------------------------------------------------------
   * * Statics
   * * -----------------------------------------------------------------
   */
  public static function recentBlogs(int $count = 5)
  {
    return static::latest('updated_at')->limit($count)->get();
  }

  /**
   * * -----------------------------------------------------------------
   * * Relations
   * * -----------------------------------------------------------------
   */
  /**
   * The `category()` function returns a relationship between the `CmsArticle` model and the
   * `CmsCategory` model
   *
   * @return BelongsTo A relationship between the CmsPost and CmsCategory models.
   */
  public function category(): BelongsTo
  {
    return $this->belongsTo(CmsCategory::class, 'cms_category_id');
  }

  /**
   * > This function returns a relationship between the `Post` model and the `User` model
   *
   * @return BelongsTo A relationship between the Post and User models.
   */
  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id');
  }
}
