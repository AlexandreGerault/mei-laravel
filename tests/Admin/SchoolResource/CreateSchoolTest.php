<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SchoolResource;
use Admin\Resources\SchoolResource\Pages\CreateSchool;
use Illuminate\Http\Testing\File;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Models\School;
use Webmozart\Assert\Assert;

test('an admin can create a school', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(SchoolResource::getUrl('create'))->assertOk();

    livewire(CreateSchool::class)
        ->fillForm([
            'name' => 'Test School',
            'logo' => File::fake()->image('logo.jpg'),
            'long_description' => 'Test Long Description',
            'short_description' => 'Test Short Description',
            'website' => 'https://test.school',
            'city' => 'Test City',
            'address' => 'Test Address',
            'region' => 'Test Region',
            'department' => 'Test Department',
            'is_public' => true,
            'foundation_year' => 2021,
        ])
        ->call('create')
        ->assertHasNoErrors();

    expect(School::where('name', 'Test School')->exists())->toBeTrue();
});
