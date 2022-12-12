<?php

namespace Database\Seeders;

use App\Helpers\Image;
use App\Models\ListedHorse;
use Illuminate\Database\Seeder;

class ListedHorseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $folder_path = storage_path('tmp\horsesSeeder');
    if (!is_dir($folder_path)) {
      mkdir($folder_path);
    }
    ListedHorse::factory()->count(10)->create()->each(function ($horse) use ($folder_path) {
      for ($i = 0; $i < 2; $i++) {
        $path = Image::image($folder_path, 640, 480, null, true, true);
        error_log($horse->id);
        $horse->addMedia($path)->toMediaCollection('photos');
      }
    });
  }
}
