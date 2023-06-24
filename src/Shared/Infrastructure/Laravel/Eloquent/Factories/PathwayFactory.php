<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Shared\Infrastructure\Laravel\Eloquent\Models\Pathway;

/**
 * @extends Factory<Pathway>
 */
class PathwayFactory extends Factory
{
    protected $model = Pathway::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'post_bac_level' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
