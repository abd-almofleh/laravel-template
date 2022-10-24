<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ListedHorse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListedHorsesOrderFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'status'          => $this->faker->randomElement(array_values(config('constants.order_status'))),
      'customer_id'     => $this->faker->unique()->randomElement(Customer::all(['id'])->pluck('id')),
      'listed_horse_id' => $this->faker->randomElement(ListedHorse::all(['id'])->pluck('id')),
      'phone_number' => $this->faker->phoneNumber,
    ];
  }
}
