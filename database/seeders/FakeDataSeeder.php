<?php

namespace Database\Seeders;

use Admin\Infrastructure\Factories\AdminFactory;
use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
        AdminFactory::new()->create(['email' => 'admin@localhost']);
    }
}
