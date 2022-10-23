<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HorsePassportFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name_en' => $this->faker->word,
      'name_ar' => 'عربي_' . $this->faker->word,
      'status'  => $this->faker->boolean,
    ];
  }
}
