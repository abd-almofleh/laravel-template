<?php

namespace Database\Seeders;

use App\Models\ListedHorsesOrder;
use Illuminate\Database\Seeder;

class ListedHorsesOrderSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    ListedHorsesOrder::factory()->count(10)->create();
  }
}
