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
    'type'      => OtpTypesEnum::class,
    'expire_at' => 'datetime',
  ];

  /**
   * find the latest `OtpVerificationCode` for a given `customerId`, `otp` and `type` if exists
   *
   * @param int customerId The customer id
   * @param string otp The OTP code that the user has entered.
   * @param OtpTypesEnum type The type of OTP verification code.
   *
   * @return ?OtpVerificationCode the result of the query
   */
  public static function get(int $customerId, string $otp, OtpTypesEnum $type): ?OtpVerificationCode
  {
    return static::query()
    ->where('customer_id', $customerId)
    ->where('otp', 'LIKE', $otp)
    ->where('type', 'LIKE', $type)
    ->latest('expire_at')
    ->first();
  }
}
