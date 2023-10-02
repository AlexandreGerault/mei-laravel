<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SpecialismResource\Pages\EditSpecialism;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SpecialismFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Specialism;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

test('an admin can edit a specialism', function () {
    $admin = AdminFactory::new()->create();
    $specialism = SpecialismFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($specialism, Specialism::class);

    actingAs($admin, 'admin');

    livewire(EditSpecialism::class, ['record' => $specialism->getRouteKey()])
        ->fillForm([
            'name' => 'Test Specialism',
            'description' => 'Description',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $specialism = $specialism->fresh();

    Assert::notNull($specialism);

    expect($specialism->name)->toBe('Test Specialism');
});
