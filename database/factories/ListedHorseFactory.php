<?php

namespace Database\Factories;

use App\Models\HorsePassport;
use App\Models\HorseType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListedHorseFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->sentence,
      'sex' => $this->faker->boolean,
      'birth_year' => $this->faker->numberBetween(2015, 2022),
      'race' => $this->faker->sentence,
      'height' => $this->faker->randomFloat(2, 1.5, 3.5),
      'weight' => $this->faker->randomFloat(2, 100, 200),
      'color' => $this->faker->colorName,
      'health' => $this->faker->sentence,
      'description' => $this->faker->paragraph,
      'contact_number' => $this->faker->phoneNumber,
      'father_name' => $this->faker->firstNameMale,
      'mother_name' => $this->faker->firstNameFemale,
      'type_id' => $this->faker->randomElement(HorseType::pluck('id')),
      'passport_type_id' => $this->faker->randomElement(HorsePassport::pluck('id')),
    ];
  }
}
