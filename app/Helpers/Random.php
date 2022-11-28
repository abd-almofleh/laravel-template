<?php

namespace App\Helpers;

class Random
{
  public static function Numbers(int $length = 6): string
  {
    $generator = '1234567890';
    $result = '';

    for ($i = 1; $i <= $length; $i++) {
      $result .= substr($generator, rand() % strlen($generator), 1);
    }

    return $result;
  }
}
