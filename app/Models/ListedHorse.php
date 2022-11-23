<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use stdClass;

class ListedHorse extends Model implements HasMedia
{
  use HasFactory;
  use SoftDeletes;
  use InteractsWithMedia;

  /* It's telling Laravel which attributes can be mass assigned. */
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

  /* It's telling Laravel to cast the `created_at`, `updated_at`, and `deleted_at` attributes to
  Carbon instances. */
  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  /* It's adding the `photos` and `videos` attributes to the model. */
  protected $appends = [
    'photos',
    'videos',
  ];
  /* Eager loading the `type` and `passport` relationships. */
  protected $with = [
    'type:id,name_en,name_ar',
    'passport:id,name_en,name_ar',
  ];

  /**
   * * -----------------------------------------------------------------
   * *
   * * -----------------------------------------------------------------
   */

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
   * * Scopes
   * * -----------------------------------------------------------------
   */

  /**
   * "Get the latest 5 posts."
   *
   * The `scope` method is a method that is available on all Eloquent models. It allows you to define a
   * scope that can be used in your Eloquent queries
   *
   * @param Builder query The query builder instance.
   * @param int count The number of records to return.
   */
  public function scopeRecent(Builder $query, int $count = 5)
  {
    $query->latest('updated_at')->limit($count)->get();
  }

  /**
   * * -----------------------------------------------------------------
   * * Relations
   * * -----------------------------------------------------------------
   */

  /**
   * The `type()` function returns a `BelongsTo` relationship between the `Horse` model and the
   * `HorseType` model
   *
   * @return BelongsTo A relationship between the Horse model and the HorseType model.
   */
  public function type(): BelongsTo
  {
    return $this->belongsTo(HorseType::class, 'type_id', 'id');
  }

  /**
   * The `passport()` function returns a `BelongsTo` relationship between the `Horse` model and the
   * `HorsePassport` model
   *
   * @return BelongsTo A collection of HorsePassport models.
   */
  public function passport(): BelongsTo
  {
    return $this->belongsTo(HorsePassport::class, 'passport_type_id', 'id');
  }

  /**
   * This function returns a HasOne relationship between the ListedHorses model and the ListedHorsesOrder
   * model, where the foreign key is listed_horse_id.
   *
   * @return HasOne A HasOne relationship.
   */
  public function order(): HasOne
  {
    return $this->hasOne(ListedHorsesOrder::class, 'listed_horse_id');
  }

  /**
   * * -----------------------------------------------------------------
   * * Attributes
   * * -----------------------------------------------------------------
   */

  /**
   * It takes the files from the media library, and creates a new object for each file, with the url,
   * fullUrl, thumbnail, and preview properties.
   *
   * @return array An array of objects.
   */
  public function getPhotosAttribute(): array
  {
    $newFiles = [];
    $files = $this->getMedia('photos');
    foreach ($files as $file) {
      $newFile = new stdClass();
      $newFile->url = $file->getUrl();
      $newFile->fullUrl = $file->getFullUrl();
      $newFile->thumbnail = $file->getFullUrl('thumb');
      $newFile->preview = $file->getFullUrl('preview');
      array_push($newFiles, $newFile);
    }
    return $newFiles;
  }

  /**
   * It takes the files from the `videos` collection, creates a new object for each file, and adds the
   * file's url, full url, thumbnail url, and preview url to the object
   *
   * @return array An array of objects.
   */
  public function getVideosAttribute(): array
  {
    $newFiles = [];
    $files = $this->getMedia('videos');
    foreach ($files as $file) {
      $newFile = new stdClass();
      $newFile->url = $file->getUrl();
      $newFile->fullUrl = $file->getFullUrl();
      $newFile->thumbnail = $file->getFullUrl('thumb');
      $newFile->preview = $file->getFullUrl('preview');
      array_push($newFiles, $newFile);
    }
    return $newFiles;
  }
}
