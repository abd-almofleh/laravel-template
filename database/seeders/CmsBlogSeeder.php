<?php

namespace Database\Seeders;

use App\Models\CmsBlog;
use App\Models\CmsCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CmsBlogSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $faker = Faker::create();
    $faker_ar = Faker::create('ar_SA');

    for ($i = 0; $i < 10; $i++) {
      CmsBlog::create([
        'title_ar'            => $faker_ar->name(),
        'title_en'            => $faker->sentence(),
        'slug'                => $faker->sentence(),
        'description_ar'      => $faker_ar->realText(),
        'description_en'      => $faker->paragraph(),
        'cms_category_id'     => $faker->randomElement(CmsCategory::pluck('id')),
        'status'              => $faker->boolean(),
        'meta_title_ar'       => $faker_ar->name(),
        'meta_title_en'       => $faker->sentence(),
        'meta_description_ar' => $faker->paragraph(),
        'meta_description_en' => $faker->paragraph(),
        'meta_keywords_ar'    => $faker_ar->name(),
        'meta_keywords_en'    => $faker->words(7, true),
        'author_id'           => $faker->randomElement(User::pluck('id')),

      ]);
    }
  }
}
