<?php

namespace Database\Seeders;

use App\Models\CmsCategory;
use Illuminate\Database\Seeder;

class CmsCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    CmsCategory::factory()->count(10)->create();
  }
}
