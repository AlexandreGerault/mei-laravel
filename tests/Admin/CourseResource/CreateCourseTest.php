<?php

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\CourseResource;
use Admin\Resources\CourseResource\Pages\CreateCourse;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SpecialismFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Course;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('an admin can create a course', function () {
    $admin = AdminFactory::new()->create();
    $specialisms = SpecialismFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(CourseResource::getUrl('create'))->assertOk();

    livewire(CreateCourse::class)
        ->fillForm([
            'name' => 'Test Course',
            'description' => 'Test Short Description',
            'specialisms' => $specialisms->pluck('id')->toArray(),
        ])
        ->call('create')
        ->assertHasNoErrors();

    $course = Course::where('name', 'Test Course')->first();

    Assert::notNull($course);

    expect($course)->toBeInstanceOf(Course::class)
        ->and($course->specialisms->count())->toBe(10);
});
