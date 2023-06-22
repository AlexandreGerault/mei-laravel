<?php

namespace Admin\Infrastructure\Factories;

use Admin\Infrastructure\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        return [
            'username' => fake()->userName,
            'email' => fake()->email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => 'https://i.pravatar.cc/300?u='.Str::random(10), // 'https://i.pravatar.cc/300?u=
        ];
    }
}
