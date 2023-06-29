<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Industry;

/** @extends Factory<Industry> */
class IndustryFactory extends Factory
{
    protected $model = Industry::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
        ];
    }

    public function withDescription(): self
    {
        return $this->state([
            'description' => fake()->text(),
        ]);
    }
}
