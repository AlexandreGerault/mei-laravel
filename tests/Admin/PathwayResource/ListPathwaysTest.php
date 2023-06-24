<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Resources\PathwayResource;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('an admin can list pathways', function () {
    $admin = AdminFactory::new()->create();

    actingAs($admin, 'admin');

    get(PathwayResource::getUrl())->assertOk();

    livewire(PathwayResource\Pages\ListPathways::class)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('post_bac_level')
        ->assertCanRenderTableColumn('description');
});
