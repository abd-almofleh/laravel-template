<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

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
    'weight',
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

  protected $appends = [
    // 'photos',
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  public function type()
  {
    return $this->belongsTo(HorseType::class, 'type_id', 'id');
  }

  public function passport()
  {
    return $this->belongsTo(HorsePassport::class, 'passport_type_id', 'id');
  }

  public function getPhotosAttribute()
  {
    $file = $this->getMedia('photo')->last();
    if ($file) {
      $file->url = $file->getUrl();
      $file->thumbnail = $file->getUrl('thumb');
      $file->preview = $file->getUrl('preview');
    }

    return $file;
  }
}
