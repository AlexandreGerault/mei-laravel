<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SpecialismResource;
use Admin\Resources\SpecialismResource\Pages\CreateSpecialism;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Models\Specialism;
use Webmozart\Assert\Assert;

test('an admin can create a specialism', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(SpecialismResource::getUrl('create'))->assertOk();

    livewire(CreateSpecialism::class)
        ->fillForm([
            'name' => 'Test Specialism',
            'description' => 'Test Short Description',
        ])
        ->call('create')
        ->assertHasNoErrors();

    expect(Specialism::where('name', 'Test Specialism')->exists())->toBeTrue();
});
