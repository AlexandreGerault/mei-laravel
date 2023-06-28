<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SchoolResource\Pages\EditSchool;
use Admin\Resources\SchoolResource\RelationManagers\CourseRelationManager;
use Admin\Resources\SchoolResource\RelationManagers\SpecialismRelationManager;
use Illuminate\Http\Testing\File;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Factories\CourseFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SchoolFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SpecialismFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\School;
use Webmozart\Assert\Assert;

test('an admin can edit a school', function () {
    $admin = AdminFactory::new()->create();
    $school = SchoolFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($school, School::class);

    actingAs($admin, 'admin');

    livewire(EditSchool::class, ['record' => $school->getRouteKey()])
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
        ->call('save')
        ->assertHasNoFormErrors();

    $school = $school->fresh();

    Assert::notNull($school);

    expect($school->name)->toBe('Test School');
});

test('the school edit page list associated specialisms', function () {
    $admin = AdminFactory::new()->create();
    $school = SchoolFactory::new()
        ->has(SpecialismFactory::new()->count(10), 'specialisms')
        ->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($school, School::class);

    actingAs($admin, 'admin');

    livewire(SpecialismRelationManager::class, ['ownerRecord' => $school])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($school->specialisms)
        ->assertCanRenderTableColumn('name');
});

test('the school edit page list associated courses', function () {
    $admin = AdminFactory::new()->create();
    $school = SchoolFactory::new()
        ->has(
            factory: SpecialismFactory::new()
                ->has(CourseFactory::new()->count(10), 'courses')
                ->count(1),
            relationship: 'specialisms'
        )
        ->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($school, School::class);

    actingAs($admin, 'admin');

    livewire(CourseRelationManager::class, ['ownerRecord' => $school])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($school->courses)
        ->assertCanRenderTableColumn('name');
});
