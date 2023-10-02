<?php

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\CourseResource\Pages\EditCourse;
use Shared\Infrastructure\Laravel\Eloquent\Factories\CourseFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Course;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

test('an admin can edit a course', function () {
    $admin = AdminFactory::new()->create();
    $course = CourseFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($course, Course::class);

    actingAs($admin, 'admin');

    livewire(EditCourse::class, ['record' => $course->getRouteKey()])
        ->fillForm([
            'name' => 'Test Course',
            'description' => 'Description',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $course = $course->fresh();

    Assert::notNull($course);

    expect($course->name)->toBe('Test Course');
});
