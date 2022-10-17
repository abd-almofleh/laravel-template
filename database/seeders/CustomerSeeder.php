<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $customer = Customer::create([
      'name' => 'Abdullah Almofleh',
      'password' => 'password',
      'email' => 'customer@temp.com',
      'phone_number' => '9876536748',
    ]);
    $customer->assignRole('customer');

    Customer::factory()->count(10)->create();
  }
}
