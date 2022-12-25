<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum HorseGender: string
{
  use Values;
  use InvokableCases;
  case Stallion = 'stallion';
  case Gelding = 'gelding';
  case Mare = 'mare';
}
