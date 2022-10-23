<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HorseTypeFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name_ar' => 'عربي_' . $this->faker->word,
      'name_en' => $this->faker->word,
      'status'  => $this->faker->boolean,
    ];
  }
}
