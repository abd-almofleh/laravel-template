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
}
