<?php

namespace Tests\Admin\DisciplineResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\DisciplineResource;
use Admin\Resources\DisciplineResource\Pages\ListDisciplines;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Webmozart\Assert\Assert;

test('an admin can list disciplines', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(DisciplineResource::getUrl())->assertOk();

    livewire(ListDisciplines::class)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('color')
        ->assertCanRenderTableColumn('description');
});
