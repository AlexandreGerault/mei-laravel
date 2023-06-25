<?php

namespace Tests\Admin\SpecialismResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SpecialismResource;
use Admin\Resources\SpecialismResource\Pages\ListSpecialisms;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Webmozart\Assert\Assert;

test('an admin can list specialisms', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(SpecialismResource::getUrl())->assertOk();

    livewire(ListSpecialisms::class)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('description');
});
