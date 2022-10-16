<?php

namespace Database\Seeders;

use App\Models\ListedHorse;
use Illuminate\Database\Seeder;

class ListedHorseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ListedHorse::factory()->count(100)->create();
  }
}
