<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListedHorsesOrder extends Model
{
  use HasFactory;

  protected $fillable = [
    'status',
    'customer_id',
    'listed_horse_id',
  ];


  public function customer()
  {
    return $this->belongsTo(Customer::class, 'customer_id');
  }

  public function listed_horse()
  {
    return $this->belongsTo(ListedHorse::class, 'listed_horse_id');
  }
}
