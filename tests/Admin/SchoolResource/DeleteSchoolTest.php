<?php

namespace Tests\Admin\PathwayResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\SchoolResource\Pages\EditSchool;
use Admin\Resources\SchoolResource\Pages\ListSchools;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;
use Shared\Infrastructure\Laravel\Eloquent\Factories\SchoolFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\School;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;

test('an admin can bulk delete schools', function () {
    $admin = AdminFactory::new()->create();
    $schools = SchoolFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($schools, Collection::class);

    actingAs($admin, 'admin');

    livewire(ListSchools::class)
        ->callTableBulkAction(DeleteBulkAction::class, $schools);

    assertDatabaseCount('schools', 0);
});

test('an admin can delete a school from a table action', function () {
    $admin = AdminFactory::new()->create();
    $school = SchoolFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($school, School::class);

    actingAs($admin, 'admin');

    livewire(ListSchools::class)
        ->callTableAction('delete', $school);

    assertDatabaseCount('schools', 0);
});

test('an admin can delete a school from the edit page', function () {
    $admin = AdminFactory::new()->create();
    $school = SchoolFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($school, School::class);

    actingAs($admin, 'admin');

    livewire(EditSchool::class, ['record' => $school->getRouteKey()])
        ->callPageAction(DeleteAction::class)
        ->assertHasNoErrors();

    assertDatabaseCount('schools', 0);
});
