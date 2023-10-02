<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SpecialismResource;
use Admin\Resources\SpecialismResource\Pages\CreateSpecialism;
use Shared\Infrastructure\Laravel\Eloquent\Factories\CourseFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\DisciplineFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\IndustryFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SchoolFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Discipline;
use Shared\Infrastructure\Laravel\Eloquent\Models\School;
use Shared\Infrastructure\Laravel\Eloquent\Models\Specialism;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('an admin can create a specialism', function () {
    $admin = AdminFactory::new()->create();
    $school = SchoolFactory::new()->create();
    $discipline = DisciplineFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($school, School::class);
    Assert::isInstanceOf($discipline, Discipline::class);

    actingAs($admin, 'admin');

    get(SpecialismResource::getUrl('create'))->assertOk();

    livewire(CreateSpecialism::class)
        ->fillForm([
            'name' => 'Test Specialism',
            'description' => 'Test Description',
            'school' => $school->id,
            'discipline' => $discipline->id,
        ])
        ->call('create')
        ->assertHasNoErrors();

    $specialism = Specialism::where('name', 'Test Specialism')->first();

    Assert::notNull($specialism);

    expect($specialism)->toBeInstanceOf(Specialism::class)
        ->and($specialism->school)->toBeInstanceOf(School::class)
        ->and($specialism->discipline)->toBeInstanceOf(Discipline::class);
});

test('a specialism can be created with attached courses', function () {
    $admin = AdminFactory::new()->create();
    $school = SchoolFactory::new()->create();
    $discipline = DisciplineFactory::new()->create();
    $courses = CourseFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($school, School::class);
    Assert::isInstanceOf($discipline, Discipline::class);

    actingAs($admin, 'admin');

    get(SpecialismResource::getUrl('create'))->assertOk();

    livewire(CreateSpecialism::class)
        ->fillForm([
            'name' => 'Test Specialism',
            'description' => 'Test Description',
            'school' => $school->id,
            'discipline' => $discipline->id,
            'courses' => $courses->pluck('id')->toArray(),
        ])
        ->call('create')
        ->assertHasNoErrors();

    $specialism = Specialism::where('name', 'Test Specialism')->first();

    Assert::notNull($specialism);

    expect($specialism)->toBeInstanceOf(Specialism::class)
        ->and($specialism->courses->count())->toBe(10);
});

test('a specialism can be created with attached industries', function () {
    $admin = AdminFactory::new()->create();
    $school = SchoolFactory::new()->create();
    $discipline = DisciplineFactory::new()->create();
    $industries = IndustryFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($school, School::class);
    Assert::isInstanceOf($discipline, Discipline::class);

    actingAs($admin, 'admin');

    get(SpecialismResource::getUrl('create'))->assertOk();

    livewire(CreateSpecialism::class)
        ->fillForm([
            'name' => 'Test Specialism',
            'description' => 'Test Description',
            'school' => $school->id,
            'discipline' => $discipline->id,
            'industries' => $industries->pluck('id')->toArray(),
        ])
        ->call('create')
        ->assertHasNoErrors();

    $specialism = Specialism::where('name', 'Test Specialism')->first();

    Assert::notNull($specialism);

    expect($specialism)->toBeInstanceOf(Specialism::class)
        ->and($specialism->industries->count())->toBe(10);
});
