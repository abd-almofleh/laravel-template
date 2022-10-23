<?php

namespace App\Services;

class HelperService
{
  /**
   * It takes a string, replaces all non-alphanumeric characters with a dash, removes duplicate dashes,
   * trims the string, and returns the result.
   *
   * @param title The title to be slugified.
   * @param string divider The character that will be used to replace spaces.
   *
   * @return ?string A slugified string.
   */
  public static function slugify(?string $title = '', string $divider = '-'): ?string
  {
    if ($title === null) {
      return null;
    }
    // replace non letter or digits by divider
    $title = preg_replace('~[^\pL\d]+~u', $divider, $title);

    // remove unwanted characters
    // $title = preg_replace('~[^-\w]+~', '', $title);

    // trim
    $title = trim($title, $divider);

    // remove duplicate divider
    $title = preg_replace('~-+~', $divider, $title);

    // lowercase
    $title = strtolower($title);

    if (empty($title)) {
      return uniqid('n-a-');
    }
    return $title;
  }
}
