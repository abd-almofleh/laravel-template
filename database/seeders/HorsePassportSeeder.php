<?php

namespace Database\Seeders;

use App\Models\HorsePassport;
use Illuminate\Database\Seeder;

class HorsePassportSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    HorsePassport::factory()->count(5)->create();
  }
}
