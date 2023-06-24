<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\PathwayResource;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Webmozart\Assert\Assert;

test('an admin can list pathways', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(PathwayResource::getUrl())->assertOk();

    livewire(PathwayResource\Pages\ListPathways::class)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('post_bac_level')
        ->assertCanRenderTableColumn('description');
});
