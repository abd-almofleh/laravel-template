<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

  protected $fillable = [
    'email',
    'phone_number',
    'name',
    'password'
  ];
  protected $hidden = ['password'];

  /**
   * @param string $password
   */
  public function setPasswordAttribute(string $password): void
  {
    $this->attributes['password'] = Hash::make($password);
  }
    /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
}
