<?php

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\CourseResource\Pages\EditCourse;
use Admin\Resources\CourseResource\Pages\ListCourses;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Factories\CourseFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Course;
use Webmozart\Assert\Assert;

test('an admin can bulk delete courses', function () {
    $admin = AdminFactory::new()->create();
    $courses = CourseFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($courses, Collection::class);

    actingAs($admin, 'admin');

    livewire(ListCourses::class)
        ->callTableBulkAction(DeleteBulkAction::class, $courses);

    assertDatabaseCount('courses', 0);
});

test('an admin can delete a course from a table action', function () {
    $admin = AdminFactory::new()->create();
    $course = CourseFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($course, Course::class);

    actingAs($admin, 'admin');

    livewire(ListCourses::class)
        ->callTableAction('delete', $course);

    assertDatabaseCount('courses', 0);
});

test('an admin can delete a course from the edit page', function () {
    $admin = AdminFactory::new()->create();
    $course = CourseFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($course, Course::class);

    actingAs($admin, 'admin');

    livewire(EditCourse::class, ['record' => $course->getRouteKey()])
        ->callPageAction(DeleteAction::class)
        ->assertHasNoErrors();

    assertDatabaseCount('courses', 0);
});
