<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SchoolResource;
use Admin\Resources\SchoolResource\Pages\ListSchools;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('an admin can list schools', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(SchoolResource::getUrl())->assertOk();

    livewire(ListSchools::class)
        ->assertCanRenderTableColumn('logo')
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('short_description')
        ->assertCanRenderTableColumn('region')
        ->assertCanRenderTableColumn('city')
        ->assertCanRenderTableColumn('website');
});
