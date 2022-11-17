<?php

namespace App\Helpers;

use Faker\Provider\Lorem;

/**
 * Depends on image generation from http://via.placeholder.com
 */
class Image
{
  /**
   * @var string
   */
  public const BASE_URL = 'http://via.placeholder.com';

  public const FORMAT_JPG = 'jpg';
  public const FORMAT_JPEG = 'jpeg';
  public const FORMAT_PNG = 'png';

  /**
   * @var array
   *
   * @deprecated Categories are no longer used as a list in the placeholder API but referenced as string instead
   */
  protected static $categories = [
    'abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife',
    'fashion', 'people', 'nature', 'sports', 'technics', 'transport',
  ];

  /**
   * Generate the URL that will return a random image
   *
   * Set randomize to false to remove the random GET parameter at the end of the url.
   *
   * @example 'http://via.placeholder.com/640x480/?12345'
   *
   * @param integer $width
   * @param integer $height
   * @param bool    $randomize
   *
   * @return string
   */
  public static function imageUrl(
    $width = 640,
    $height = 480,
    $category = null,
    $randomize = true,
    $word = null,
    $format = 'jpg'
  ) {
    // Validate image format
    $imageFormats = static::getFormats();

    if (!in_array(strtolower($format), $imageFormats, true)) {
      throw new \InvalidArgumentException(sprintf(
        'Invalid image format "%s". Allowable formats are: %s',
        $format,
        implode(', ', $imageFormats)
      ));
    }

    $size = sprintf('%dx%d.%s', $width, $height, $format);

    $imageParts = [];

    if ($category !== null) {
      $imageParts[] = $category;
    }

    if ($word !== null) {
      $imageParts[] = $word;
    }

    if ($randomize === true) {
      $imageParts[] = Lorem::word();
    }

    return sprintf(
      '%s/%s%s',
      self::BASE_URL,
      $size,
      count($imageParts) > 0 ? '?text=' . urlencode(implode(' ', $imageParts)) : ''
    );
  }

  /**
   * Download a remote random image to disk and return its location
   *
   * Requires curl, or allow_url_fopen to be on in php.ini.
   *
   * @param  null                          $dir
   * @param  int                           $width
   * @param  int                           $height
   * @param  bool                          $fullPath
   * @param  bool                          $randomize
   * @return bool|\RuntimeException|string
   * @example '/path/to/dir/13b73edae8443990be1aa8f1a483bc27.jpg'
   */
  public static function image(
    string $dir = null,
    int $width = 640,
    int $height = 480,
    string $category = null,
    bool $fullPath = true,
    bool $randomize = true,
    string $word = null,
    string $format = 'png'
  ) {
    $dir = is_null($dir) ? sys_get_temp_dir() : $dir; // GNU/Linux / OS X / Windows compatible
    // Validate directory path
    if (!is_dir($dir) || !is_writable($dir)) {
      throw new \InvalidArgumentException(sprintf('Cannot write to directory "%s"', $dir));
    }

    // Generate a random filename. Use the server address so that a file
    // generated at the same time on a different server won't have a collision.
    $name = md5(uniqid(empty($_SERVER['SERVER_ADDR']) ? '' : $_SERVER['SERVER_ADDR'], true));
    $filename = sprintf('%s.%s', $name, $format);
    $filepath = $dir . DIRECTORY_SEPARATOR . $filename;

    $url = static::imageUrl($width, $height, $category, $randomize);

    // save file
    if (function_exists('curl_exec')) {
      // use cURL
      $fp = fopen($filepath, 'w');
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_FILE, $fp);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
      curl_setopt($ch, CURLOPT_VERBOSE, false);   // Enable this line to see debug prints
      $success = curl_exec($ch) && curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;
      curl_close($ch);
      fclose($fp);

      if (!$success) {
        unlink($filepath);

        // could not contact the distant URL or HTTP error - fail silently.
        return false;
      }
    } else {
      return new \RuntimeException('The image formatter downloads an image from a remote HTTP server. Therefore, it requires that PHP can request remote hosts, either via cURL or fopen()');
    }

    return $fullPath ? $filepath : $filename;
  }

  public static function getFormats(): array
  {
    return array_keys(static::getFormatConstants());
  }

  public static function getFormatConstants(): array
  {
    return [
      static::FORMAT_JPG  => constant('IMAGETYPE_JPEG'),
      static::FORMAT_JPEG => constant('IMAGETYPE_JPEG'),
      static::FORMAT_PNG  => constant('IMAGETYPE_PNG'),
    ];
  }
}
