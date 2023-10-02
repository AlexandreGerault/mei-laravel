<?php

namespace Tests\Admin;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Filament\Http\Livewire\Auth\Login;
use Webmozart\Assert\Assert;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('an admin can login to Laravel Filament', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    get('/admin')->assertRedirect('/admin/login');

    livewire(Login::class)
        ->fillForm([
            'email' => $admin->email,
            'password' => 'password',
        ])
        ->call('authenticate')
        ->assertHasNoFormErrors()
        ->assertSuccessful();

    assertAuthenticatedAs($admin, 'admin');
});
