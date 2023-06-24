<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\PathwayResource\Pages\EditPathway;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Factories\PathwayFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Pathway;
use Webmozart\Assert\Assert;

test('an admin can edit a pathway', function () {
    $admin = AdminFactory::new()->create();
    $pathway = PathwayFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($pathway, Pathway::class);

    actingAs($admin, 'admin');

    livewire(EditPathway::class, ['record' => $pathway->getRouteKey()])
        ->fillForm([
            'name' => 'Test Pathway',
            'description' => 'Test Description',
            'post_bac_level' => 4,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $pathway = $pathway->fresh();

    Assert::notNull($pathway);

    expect($pathway->name)->toBe('Test Pathway');
});
