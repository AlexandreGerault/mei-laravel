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
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'logo' => $this->faker->word(),
            'long_description' => $this->faker->text(),
            'short_description' => $this->faker->text(),
            'website' => $this->faker->word(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'region' => $this->faker->word(),
            'department' => $this->faker->word(),
            'is_public' => $this->faker->boolean(),
            'foundation_year' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
