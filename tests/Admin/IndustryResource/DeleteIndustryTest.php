<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\IndustryResource\Pages\EditIndustry;
use Admin\Resources\IndustryResource\Pages\ListIndustries;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;
use Shared\Infrastructure\Laravel\Eloquent\Factories\IndustryFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Industry;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;

test('an admin can bulk delete industries', function () {
    $admin = AdminFactory::new()->create();
    $industries = IndustryFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($industries, Collection::class);

    actingAs($admin, 'admin');

    livewire(ListIndustries::class)
        ->callTableBulkAction(DeleteBulkAction::class, $industries);

    assertDatabaseCount('industries', 0);
});

test('an admin can delete an industry from a table action', function () {
    $admin = AdminFactory::new()->create();
    $industry = IndustryFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($industry, Industry::class);

    actingAs($admin, 'admin');

    livewire(ListIndustries::class)
        ->callTableAction('delete', $industry);

    assertDatabaseCount('industries', 0);
});

test('an admin can delete an industry from the edit page', function () {
    $admin = AdminFactory::new()->create();
    $industry = IndustryFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($industry, Industry::class);

    actingAs($admin, 'admin');

    livewire(EditIndustry::class, ['record' => $industry->getRouteKey()])
        ->callPageAction(DeleteAction::class)
        ->assertHasNoErrors();

    assertDatabaseCount('industries', 0);
});
