<?php

namespace Database\Seeders;

use Admin\Infrastructure\Factories\AdminFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Shared\Infrastructure\Laravel\Eloquent\Factories\AdmissionFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\CourseFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\DisciplineFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\IndustryFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\PathwayFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SchoolFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SpecialismFactory;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
        AdminFactory::new()->create([
            'avatar' => null,
            'email' => 'admin@localhost',
            'password' => Hash::make('password'),
        ]);

        $pathways = PathwayFactory::new()->count(100)->create();
        $admissions = AdmissionFactory::new()->recycle($pathways)->count(100)->create();
        $industries = IndustryFactory::new()->count(50)->create();
        $disciplines = DisciplineFactory::new()->count(30)->create();

        $schools = SchoolFactory::new()->count(150)->create();
        $specialisms = SpecialismFactory::new()
            ->recycle($schools)
            ->recycle($disciplines)
            ->recycle($industries)
            ->count(150)
            ->create();
        CourseFactory::new()
            ->recycle($specialisms)
            ->recycle($admissions)
            ->has(SpecialismFactory::new()->count(2), 'specialisms')
            ->has(AdmissionFactory::new()->count(2), 'admissions')
            ->count(350)
            ->create();
    }
}
