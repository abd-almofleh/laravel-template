<?php

namespace Database\Seeders;

use App\Models\HorseType;
use Illuminate\Database\Seeder;

class HorseTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    HorseType::factory()->count(10)->create();
  }
}
