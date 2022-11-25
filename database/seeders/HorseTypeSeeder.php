<?php

namespace Database\Seeders;

use App\Helpers\Image;
use App\Models\HorseType;
use Illuminate\Database\Seeder;

class HorseTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $folder_path = storage_path('tmp\horsesTypesSeeder');
    if (!is_dir($folder_path)) {
      mkdir($folder_path);
    }
    HorseType::factory()->count(10)->create()->each(function ($type) use ($folder_path) {
      $path = Image::image($folder_path, 640, 480, null, true, true);
      error_log($type->id);
      sleep(1);
      $type->addMedia($path)->toMediaCollection('photos');
    });
  }
}
