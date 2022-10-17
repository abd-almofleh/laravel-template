<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      RolePermissionSeeder::class,
      AdminSeeder::class,
      CurrencySeeder::class,
      SettingSeeder::class,
      HorseTypeSeeder::class,
      HorsePassportSeeder::class,
      ListedHorseSeeder::class,
      ApiRolePermissionSeeder::class,
      CustomerSeeder::class
    ]);
  }
}
