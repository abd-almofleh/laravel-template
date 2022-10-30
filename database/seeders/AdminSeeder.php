<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $user = User::Where('email', 'admin@example.com')->first();

    if (is_null($user)) {
      $user = User::create([
        'name'     => 'Abdullah Almofleh',
        'email'    => 'admin@admin.com',
        'mobile'   => '0505108253',
        'password' => bcrypt('password'),
        'status'   => 1,
      ]);

      $user->assignRole('Super Admin');
    }
  }
}
