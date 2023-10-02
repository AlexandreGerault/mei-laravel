<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\IndustryResource;
use Admin\Resources\IndustryResource\Pages\CreateIndustry;
use Shared\Infrastructure\Laravel\Eloquent\Models\Industry;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('an admin can create an industry', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(IndustryResource::getUrl('create'))->assertOk();

    livewire(CreateIndustry::class)
        ->fillForm([
            'name' => 'Test Industry',
            'description' => 'Test Description',
        ])
        ->call('create')
        ->assertHasNoErrors();

    expect(Industry::where('name', 'Test Industry')->exists())->toBeTrue();
});
