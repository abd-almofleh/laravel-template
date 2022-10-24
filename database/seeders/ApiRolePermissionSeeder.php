<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ApiRolePermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $customerRole = Role::create([
      'name'       => 'Customer',
      'code'       => 'customer',
      'guard_name' => 'api',
    ]);

    //permission list as array
    $permissions = [
      'profile:index',
      'profile:update',
      
      'listedHorse:order',
    ];

    //create and assign permission
    for ($i = 0; $i < count($permissions); $i++) {
      $permission = Permission::create(['name' => $permissions[$i], 'guard_name' => 'api']);

      $customerRole->givePermissionTo($permission);
      $permission->assignRole($customerRole);
    }
  }
}
