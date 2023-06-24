<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\PathwayResource\Pages\EditPathway;
use Admin\Resources\PathwayResource\Pages\ListPathways;
use Database\Factories\PathwayFactory;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Models\Pathway;
use Webmozart\Assert\Assert;

test('an admin can bulk delete pathways', function () {
    $admin = AdminFactory::new()->create();
    $pathways = PathwayFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($pathways, Collection::class);

    actingAs($admin, 'admin');

    livewire(ListPathways::class)
        ->callTableBulkAction(DeleteBulkAction::class, $pathways);

    assertDatabaseCount('pathways', 0);
});

test('an admin can delete a pathway from a table action', function () {
    $admin = AdminFactory::new()->create();
    $pathway = PathwayFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($pathway, Pathway::class);

    actingAs($admin, 'admin');

    livewire(ListPathways::class)
        ->callTableAction('delete', $pathway);

    assertDatabaseCount('pathways', 0);
});

test('an admin can delete a pathway from the edit page', function () {
    $admin = AdminFactory::new()->create();
    $pathway = PathwayFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($pathway, Pathway::class);

    actingAs($admin, 'admin');

    livewire(EditPathway::class, ['record' => $pathway->getRouteKey()])
        ->callPageAction(DeleteAction::class)
        ->assertHasNoErrors();

    assertDatabaseCount('pathways', 0);
});
