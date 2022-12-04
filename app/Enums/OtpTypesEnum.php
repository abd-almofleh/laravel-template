<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum OtpTypesEnum: string
{
  use Values;
  use InvokableCases;
  case PhoneNumber = 'PhoneNumber';
  case ResetPassword = 'ResetPassword';
}
