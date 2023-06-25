<?php

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\CourseResource;
use Admin\Resources\CourseResource\Pages\CreateCourse;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Models\Course;
use Webmozart\Assert\Assert;

test('an admin can create a course', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(CourseResource::getUrl('create'))->assertOk();

    livewire(CreateCourse::class)
        ->fillForm([
            'name' => 'Test Course',
            'description' => 'Test Short Description',
        ])
        ->call('create')
        ->assertHasNoErrors();

    expect(Course::where('name', 'Test Course')->exists())->toBeTrue();
});
