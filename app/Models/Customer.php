<?php

namespace App\Models;

use App\Models\Customer as ModelsCustomer;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
  use HasFactory;
  use HasApiTokens;
  use Notifiable;
  use HasRoles;
  use SoftDeletes;

  protected $guard = 'customer_frontend';

  protected $fillable = [
    'email',
    'phone_number',
    'name',
    'password',
    'birth_date',
    'is_otp_enabled',
    'phone_verified_at',
  ];
  protected $hidden = ['password'];

  /**
   * @param string $password
   */
  public function setPasswordAttribute(?string $password): void
  {
    if ($password === null) {
      return;
    }

    $this->attributes['password'] = Hash::make($password);
  }
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at'     => 'datetime',
    'birth_date'            => 'date',
    'is_otp_enabled'        => 'boolean',
  ];

  public function orders()
  {
    return $this->hasMany(ListedHorsesOrder::class, 'customer_id');
  }

  public static function findByEmail(string $email): ?ModelsCustomer
  {
    return Customer::where('email', 'LIKE', $email)->first();
  }

  public static function findByEmailOrFail(string $email): ModelsCustomer
  {
    $customer = static::findByEmail($email);
    if (!$customer) {
      abort(404, 'Email not found');
    }
    return $customer;
  }
}
