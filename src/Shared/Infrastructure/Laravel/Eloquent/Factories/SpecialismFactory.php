<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Shared\Infrastructure\Laravel\Eloquent\Models\Specialism;

/**
 * @extends Factory<Specialism>
 */
class SpecialismFactory extends Factory
{
    protected $model = Specialism::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'description' => fake()->text(),
            'discipline_id' => DisciplineFactory::new(),
            'school_id' => SchoolFactory::new(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
