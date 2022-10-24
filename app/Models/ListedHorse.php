<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ListedHorse extends Model implements HasMedia
{
  use HasFactory;
  use SoftDeletes;
  use InteractsWithMedia;

  protected $fillable = [
    'name',
    'sex',
    'bread',
    'birth_year',
    'race',
    'height',
    'color',
    'health',
    'description',
    'contact_number',
    'father_name',
    'mother_name',
    'type_id',
    'passport_type_id',
    'meta_title',
    'meta_description',
    'meta_keywords',
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  protected $appends = [
    'photos',
    'videos',
  ];
  protected $with = [
    'type:id,name_en,name_ar',
    'passport:id,name_en,name_ar',
  ];

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 50, 50)->performOnCollections('photos');
    $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 120, 120)->performOnCollections('photos');
  }

  /** ------------------------------------------
   *
   * ? Relations.
   *
   * ------------------------------------------ */

  /**
   * It says that the Horse model has a relationship with the HorseType model, and that the foreign key
   * is type_id, and the local key is id.
   *
   * @return The relationship between the Horse and HorseType models.
   */
  public function type()
  {
    return $this->belongsTo(HorseType::class, 'type_id', 'id');
  }

  public function passport()
  {
    return $this->belongsTo(HorsePassport::class, 'passport_type_id', 'id');
  }

  public function order()
  {
    return $this->hasOne(ListedHorsesOrder::class, 'listed_horse_id');
  }

  /** ------------------------------------------
   *
   * ? Attributes.
   *
   * ------------------------------------------ */

  /**
   * It returns a collection of media files, and for each file, it adds a `url`, `thumbnail`, and
   * `preview` property.
   *
   * The `getMedia()` method is provided by the `HasMedia` trait. It returns a collection of media files
   * that are associated with the model.
   *
   * The `getUrl()` method is provided by the `HasMedia` trait. It returns the URL of the media file.
   *
   * The `getFullUrl()` method is provided by the `HasMedia` trait. It returns the URL of the media file,
   * including the domain name.
   *
   * The `thumb` and `preview` are the names of the conversion profiles that were defined in the
   * `registerMediaConversions()` method.
   *
   * The `thumb` and `preview` properties are used in the Vue component to display the thumbnail and
   * preview images
   *
   * @return MediaCollection A collection of media objects.
   */
  public function getPhotosAttribute(): MediaCollection
  {
    $files = $this->getMedia('photos');
    foreach ($files as $file) {
      $file->url = $file->getUrl();
      $file->thumbnail = $file->getFullUrl('thumb');
      $file->preview = $file->getFullUrl('preview');
    }
    return $files;
  }

  /**
   * It returns a collection of media files that are associated with the model, and adds a few extra
   * properties to each file.
   * </code>
   *
   * @return MediaCollection A collection of media files.
   */
  public function getVideosAttribute(): MediaCollection
  {
    $files = $this->getMedia('videos');
    foreach ($files as $file) {
      $file->url = $file->getUrl();
      $file->thumbnail = $file->getFullUrl('thumb');
      $file->preview = $file->getFullUrl('preview');
    }
    return $files;
  }

/**
 * Retrieve the model for a bound value.
 *
 * @param  mixed                                    $value
 * @param  string|null                              $field
 * @return \Illuminate\Database\Eloquent\Model|null
 */
public function resolveRouteBinding($value, $field = null)
{
  return $this->withTrashed()->where('id', $value)->firstOrFail();
}
}
