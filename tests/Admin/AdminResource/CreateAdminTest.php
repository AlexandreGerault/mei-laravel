<?php

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\AdminResource;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;
use Webmozart\Assert\Assert;

test('an admin can create another admin', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin')
        ->get(AdminResource::getUrl('create'))
        ->assertSuccessful();

    livewire(AdminResource\Pages\CreateAdmin::class)
        ->fillForm([
            'username' => 'test',
            'email' => 'new-admin@localhost',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
        ->call('create')
        ->assertHasNoFormErrors();
});
