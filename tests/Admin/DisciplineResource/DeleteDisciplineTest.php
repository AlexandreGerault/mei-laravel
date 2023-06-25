<?php

namespace Tests\Admin\DisciplineResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\DisciplineResource\Pages\EditDiscipline;
use Admin\Resources\DisciplineResource\Pages\ListDisciplines;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Factories\DisciplineFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Discipline;
use Webmozart\Assert\Assert;

test('an admin can bulk delete disciplines', function () {
    $admin = AdminFactory::new()->create();
    $disciplines = DisciplineFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($disciplines, Collection::class);

    actingAs($admin, 'admin');

    livewire(ListDisciplines::class)
        ->callTableBulkAction(DeleteBulkAction::class, $disciplines);

    assertDatabaseCount('disciplines', 0);
});

test('an admin can delete a discipline from a table action', function () {
    $admin = AdminFactory::new()->create();
    $discipline = DisciplineFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($discipline, Discipline::class);

    actingAs($admin, 'admin');

    livewire(ListDisciplines::class)
        ->callTableAction('delete', $discipline);

    assertDatabaseCount('disciplines', 0);
});

test('an admin can delete a discipline from the edit page', function () {
    $admin = AdminFactory::new()->create();
    $discipline = DisciplineFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($discipline, Discipline::class);

    actingAs($admin, 'admin');

    livewire(EditDiscipline::class, ['record' => $discipline->getRouteKey()])
        ->callPageAction(DeleteAction::class)
        ->assertHasNoErrors();

    assertDatabaseCount('disciplines', 0);
});
