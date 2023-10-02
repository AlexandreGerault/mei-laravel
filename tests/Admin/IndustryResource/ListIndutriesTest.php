<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\IndustryResource;
use Admin\Resources\IndustryResource\Pages\ListIndustries;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('an admin can list industries', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(IndustryResource::getUrl())->assertOk();

    livewire(ListIndustries::class)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('description');
});
