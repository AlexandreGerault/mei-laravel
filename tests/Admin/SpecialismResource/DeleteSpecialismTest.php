<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SpecialismResource\Pages\EditSpecialism;
use Admin\Resources\SpecialismResource\Pages\ListSpecialisms;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SpecialismFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Specialism;
use Webmozart\Assert\Assert;

test('an admin can bulk delete specialisms', function () {
    $admin = AdminFactory::new()->create();
    $specialisms = SpecialismFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($specialisms, Collection::class);

    actingAs($admin, 'admin');

    livewire(ListSpecialisms::class)
        ->callTableBulkAction(DeleteBulkAction::class, $specialisms);

    assertDatabaseCount('specialisms', 0);
});

test('an admin can delete a specialism from a table action', function () {
    $admin = AdminFactory::new()->create();
    $specialism = SpecialismFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($specialism, Specialism::class);

    actingAs($admin, 'admin');

    livewire(ListSpecialisms::class)
        ->callTableAction('delete', $specialism);

    assertDatabaseCount('specialisms', 0);
});

test('an admin can delete a specialism from the edit page', function () {
    $admin = AdminFactory::new()->create();
    $specialism = SpecialismFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($specialism, Specialism::class);

    actingAs($admin, 'admin');

    livewire(EditSpecialism::class, ['record' => $specialism->getRouteKey()])
        ->callPageAction(DeleteAction::class)
        ->assertHasNoErrors();

    assertDatabaseCount('specialisms', 0);
});
