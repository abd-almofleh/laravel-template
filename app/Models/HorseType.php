<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HorseType extends Model implements HasMedia
{
  use HasFactory;
  use InteractsWithMedia;

  /* A list of attributes that can be mass assigned. */
  protected $fillable = [
    'name_ar',
    'name_en',
    'status',
  ];

  /* Telling Laravel to not include the `media` attribute when the model is converted to an array or
  JSON. */
  protected $hidden = [
    'created_at',
    'updated_at',
    'status',
    'media',
  ];

  /* Telling Laravel to append the `photo` attribute to the model when it is converted to an array or
  JSON. */
  protected $appends = [
    'photo',
    'name',
  ];

  protected $with = [
    'media',
  ];

  /**
   * This function returns a collection of ListedHorse models that are related to the current model
   * instance.
   *
   * @return HasMany A collection of ListedHorse models.
   */
  public function horses(): HasMany
  {
    return $this->hasMany(ListedHorse::class, 'type_id');
  }

  /**
   * Scope a query to only include active types.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   */
  public function scopeActive($query)
  {
    $query->where('status', 1);
  }

  /**
   * > If there is a photo, return the photo's url, fullUrl, thumbnail, and preview
   *
   * @return object The first photo in the photos collection.
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
   * It returns the name of the model in the current locale
   *
   * @return string The name attribute of the model.
   */
  public function getNameAttribute(): string
  {
    switch(app()->getLocale()) {
      case 'en':
        return $this->name_en;
        break;
      case 'ar':
        return $this->name_ar;
        break;
      default:
        return $this->name_en;
    }
  }

  /**
   * > This function returns the URL of the page that lists all horses of this type
   *
   * @return string The route to the listed horses page with the type of horse being passed in.
   */
  public function getUrlAttribute(): string
  {
    return route('listed_horses.list', ['type'=> $this->id]);
  }

  /**
   * It takes an array of query parameters, adds the type of horse to the array, and then returns the URL
   * of the list of horses
   *
   * @param array query The query parameters that are passed to the route.
   *
   * @return string A string
   */
  public function buildUrl(array $query = []): string
  {
    $query['type'] = $this->id;
    return route('listed_horses.list', $query);
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
}
