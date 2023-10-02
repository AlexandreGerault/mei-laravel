<?php

namespace Tests\Admin\DisciplineResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\DisciplineResource;
use Admin\Resources\DisciplineResource\Pages\ListDisciplines;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

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
