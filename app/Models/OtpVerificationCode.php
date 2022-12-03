<?php

namespace App\Models;

use App\Enums\OtpTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerificationCode extends Model
{
  use HasFactory;
  protected $fillable = ['customer_id', 'otp', 'expire_at', 'type'];

  protected $casts = [
    'type' => OtpTypesEnum::class
  ];
}
