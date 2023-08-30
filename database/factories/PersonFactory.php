<?php

namespace Database\Factories;

use App\Models\Organisation;
use Illuminate\Database\Eloquent\Factories\Factory;


class PersonFactory extends Factory{
public function definition()
{
    return [
        'civility_id' => rand(1,3),
        'last_name' => fake()->lastName(),
        'first_name' => fake()->firstName(),
        'email' => fake()->unique()->safeEmail(),
        'phone' => fake()->numerify('06########'),
        'organisation_id' => Organisation::factory(),
    ];
}
}

