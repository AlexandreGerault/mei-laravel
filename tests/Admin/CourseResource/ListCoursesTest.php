<?php

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\CourseResource;
use Admin\Resources\CourseResource\Pages\ListCourses;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Webmozart\Assert\Assert;

test('an admin can list courses', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(CourseResource::getUrl())->assertOk();

    livewire(ListCourses::class)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('description');
});
