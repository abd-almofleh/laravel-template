<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $role = Role::create([
      'name'      => 'Super Admin',
      'code'      => 'super_admin',
      'guard_name'=> 'admin',
    ]);

    //create role
    $role = Role::create([
      'name'      => 'Admin',
      'code'      => 'admin',
      'guard_name'=> 'admin',
    ]);

    //permission list as array
    $permissions = [
      'user-list',
      'user-create',
      'user-edit',
      'user-delete',

      'profile:index',

      'role-list',
      'role-create',
      'role-edit',
      'role-delete',

      'permission-list',
      'permission-create',
      'permission-edit',
      'permission-delete',

      'cms.category:list',
      'cms.category:create',
      'cms.category:edit',

      'cms.blog:list',
      'cms.blog:create',
      'cms.blog:edit',
      'cms.blog:delete',
      'cms.blog:show',

      'horseType-list',
      'horseType-create',
      'horseType-edit',

      'horsePassport-list',
      'horsePassport-create',
      'horsePassport-edit',

      'listedHorses:list',
      'listedHorses:create',
      'listedHorses:edit',
      'listedHorses:delete',
      'listedHorses:show',
      'listedHorse:order',

      'currency-list',
      'currency-create',
      'currency-edit',
      'currency-delete',

      'file-manager',
      'websetting-edit',
      'user-activity',
      'log-view',
    ];

    //create and assign permission
    for ($i = 0; $i < count($permissions); $i++) {
      $permission = Permission::create(['name' => $permissions[$i], 'guard_name'=> 'admin']);

      $role->givePermissionTo($permission);
      $permission->assignRole($role);
    }
  }
}
