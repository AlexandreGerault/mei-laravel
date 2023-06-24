<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Resources\PathwayResource\Pages\EditPathway;
use Database\Factories\PathwayFactory;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

test('an admin can edit a pathway', function () {
    $admin = AdminFactory::new()->create();
    $pathway = PathwayFactory::new()->create();

    actingAs($admin, 'admin');

    livewire(EditPathway::class, ['record' => $pathway->getRouteKey()])
        ->fillForm([
            'name' => 'Test Pathway',
            'description' => 'Test Description',
            'post_bac_level' => 4,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($pathway->fresh()->name)->toBe('Test Pathway');
});
