<?php

namespace Tests\Admin\AdmissionResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\AdmissionResource\Pages\EditAdmission;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Factories\AdmissionFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\PathwayFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Admission;
use Webmozart\Assert\Assert;

test('an admin can edit an admission', function () {
    $admin = AdminFactory::new()->create();
    $admission = AdmissionFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($admission, Admission::class);

    actingAs($admin, 'admin');

    livewire(EditAdmission::class, ['record' => $admission->getRouteKey()])
        ->fillForm([
            'name' => 'Test Admission',
            'description' => 'Test Description',
            'pathway' => PathwayFactory::new()->create()->id,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($admission->fresh()->name)->toBe('Test Admission');
});
