<?php

namespace Database\Seeders;

use Admin\Infrastructure\Factories\AdminFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
        AdminFactory::new()->create([
            'avatar' => null,
            'email' => 'admin@localhost',
            'password' => Hash::make('password'),
        ]);
    }
}
