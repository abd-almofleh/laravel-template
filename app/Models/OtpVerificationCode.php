<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerificationCode extends Model
{
  use HasFactory;
  protected $fillable = ['customer_id', 'otp', 'expire_at'];
}
