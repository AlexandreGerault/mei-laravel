<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Resources\PathwayResource;
use Admin\Resources\PathwayResource\Pages\CreatePathway;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Models\Pathway;

test('an admin can create a pathway', function () {
    $admin = AdminFactory::new()->create();

    actingAs($admin, 'admin');

    get(PathwayResource::getUrl('create'))->assertOk();

    livewire(CreatePathway::class)
        ->fillForm([
            'name' => 'Test Pathway',
            'description' => 'Test Description',
            'post_bac_level' => 4,
        ])
        ->call('create')
        ->assertHasNoErrors();

    expect(Pathway::where('name', 'Test Pathway')->exists())->toBeTrue();
});
