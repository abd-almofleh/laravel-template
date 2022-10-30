<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run()
  {
    $this->call([
      RolePermissionSeeder::class,
      AdminSeeder::class,
      CurrencySeeder::class,
      CmsCategorySeeder::class,
      CmsBlogSeeder::class,
      SettingSeeder::class,
      HorseTypeSeeder::class,
      HorsePassportSeeder::class,
      ListedHorseSeeder::class,
      ApiRolePermissionSeeder::class,
      CustomerGuardRolePermissionSeeder::class,
      CustomerSeeder::class,
      ListedHorsesOrderSeeder::class,
    ]);
  }
}
