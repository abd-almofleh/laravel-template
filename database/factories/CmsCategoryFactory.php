<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CmsCategoryFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name_en' => $this->faker->name,
      'name_ar' => $this->faker->name,
      'status'  => $this->faker->boolean,
    ];
  }
}
