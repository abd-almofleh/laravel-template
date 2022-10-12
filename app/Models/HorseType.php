<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorseType extends Model
{
  use HasFactory;

  /* A list of attributes that can be mass assigned. */
  protected $fillable = [
    'name',
    'status'
  ];

  public function horses()
  {
    return $this->hasMany(Horse::class, 'type_id');
  }
}
