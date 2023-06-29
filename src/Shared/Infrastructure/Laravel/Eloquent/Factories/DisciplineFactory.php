<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Shared\Infrastructure\Laravel\Eloquent\Models\Discipline;

/**
 * @extends Factory<Discipline>
 */
class DisciplineFactory extends Factory
{
    protected $model = Discipline::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'description' => fake()->text(),
            'color' => fake()->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
