<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Shared\Infrastructure\Laravel\Eloquent\Models\School;

/** @extends Factory<School> */
class SchoolFactory extends Factory
{
    protected $model = School::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'slug' => fake()->slug(),
            'logo' => fake()->word(),
            'long_description' => fake()->text(),
            'short_description' => fake()->text(),
            'website' => fake()->url(),
            'city' => fake()->city(),
            'address' => fake()->address(),
            'region' => fake()->word(),
            'department' => fake()->word(),
            'is_public' => fake()->boolean(),
            'foundation_date' => fake()->numberBetween(1900, 2023),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
