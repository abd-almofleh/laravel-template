<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Model
{
  use HasFactory;
  use HasApiTokens;
  use Notifiable;

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
}
