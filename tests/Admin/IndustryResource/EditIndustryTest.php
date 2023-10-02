<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\IndustryResource\Pages\EditIndustry;
use Shared\Infrastructure\Laravel\Eloquent\Factories\IndustryFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Industry;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

test('an admin can edit an industry', function () {
    $admin = AdminFactory::new()->create();
    $industry = IndustryFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($industry, Industry::class);

    actingAs($admin, 'admin');

    livewire(EditIndustry::class, ['record' => $industry->getRouteKey()])
        ->fillForm([
            'name' => 'Test Industry',
            'description' => 'Test Description',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $industry = $industry->fresh();

    Assert::notNull($industry);

    expect($industry->name)->toBe('Test Industry');
});
