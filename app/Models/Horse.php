<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horse extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'name',
    'sex',
    'bread',
    'berth_year',
    'bread',
    'height',
    'Weight',
    'color',
    'health',
    'description',
    'contact_number',
    'father_name',
    'mother_name',
    'type_id',
    'passport_type_id',
  ];

  public function type()
  {
    return $this->belongsTo(HorseType::class, 'type_id','id');
  }

  public function passport()
  {
    return $this->belongsTo(HorsePassport::class, 'passport_type_id','id');
  }
}
