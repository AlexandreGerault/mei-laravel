<?php

namespace Tests\Admin\AdminResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\AdminResource;
use Webmozart\Assert\Assert;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

test('an admin can see the admins index page', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin')
        ->get(AdminResource::getUrl())
        ->assertSuccessful();
});

test('table list essential information', function () {
    livewire(AdminResource\Pages\ListAdmins::class)
        ->assertCanRenderTableColumn('username')
        ->assertCanRenderTableColumn('email')
        ->assertCanRenderTableColumn('avatar');
});
