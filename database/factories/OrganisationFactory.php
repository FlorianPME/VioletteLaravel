<?php

namespace Database\Factories;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganisationFactory extends Factory{
    public function definition()
    {
        return [
            'organisation_name' => fake()->lexify('?????????'),
            'sector_id' => rand(1, 25),
            'postal_code' => rand(00000, 99999),
            'city' => fake()->city(),
            'chiffre_affaires' => rand(1000, 99999999),
        ];
    }
}