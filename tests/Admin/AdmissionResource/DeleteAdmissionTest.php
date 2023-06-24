<?php

namespace Tests\Admin\AdmissionResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\AdmissionResource\Pages\EditAdmission;
use Admin\Resources\AdmissionResource\Pages\ListAdmissions;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Factories\AdmissionFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Admission;
use Webmozart\Assert\Assert;

test('an admin can bulk delete admissions', function () {
    $admin = AdminFactory::new()->create();
    $admissions = AdmissionFactory::new()->count(10)->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($admissions, Collection::class);

    actingAs($admin, 'admin');

    livewire(ListAdmissions::class)
        ->callTableBulkAction(DeleteBulkAction::class, $admissions);

    assertDatabaseCount('admissions', 0);
});

test('an admin can delete a admission from a table action', function () {
    $admin = AdminFactory::new()->create();
    $admission = AdmissionFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($admission, Admission::class);

    actingAs($admin, 'admin');

    livewire(ListAdmissions::class)
        ->callTableAction('delete', $admission);

    assertDatabaseCount('admissions', 0);
});

test('an admin can delete a admission from the edit page', function () {
    $admin = AdminFactory::new()->create();
    $admission = AdmissionFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($admission, Admission::class);

    actingAs($admin, 'admin');

    livewire(EditAdmission::class, ['record' => $admission->getRouteKey()])
        ->callPageAction(DeleteAction::class)
        ->assertHasNoErrors();

    assertDatabaseCount('admissions', 0);
});
