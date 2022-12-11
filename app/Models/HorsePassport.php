<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorsePassport extends Model
{
  use HasFactory;

  /* A list of attributes that can be mass assigned. */
  protected $fillable = [
    'name_ar',
    'name_en',
    'status',
  ];

  /* Appending the name attribute to the model. */
  protected $append = [
    'name',
  ];

  public function horses()
  {
    return $this->hasMany(ListedHorse::class, 'passport_type_id');
  }

  /**
   * Scope a query to only include active passports.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   */
  public function scopeActive($query)
  {
    $query->where('status', 1);
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
}
