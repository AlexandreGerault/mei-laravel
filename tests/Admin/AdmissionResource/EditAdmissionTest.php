<?php

namespace Tests\Admin\AdmissionResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\AdmissionResource\Pages\EditAdmission;
use Shared\Infrastructure\Laravel\Eloquent\Factories\AdmissionFactory;
use Shared\Infrastructure\Laravel\Eloquent\Factories\PathwayFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Admission;
use Shared\Infrastructure\Laravel\Eloquent\Models\Pathway;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

test('an admin can edit an admission', function () {
    $admin = AdminFactory::new()->create();
    $admission = AdmissionFactory::new()->create();
    $pathway = PathwayFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($admission, Admission::class);
    Assert::isInstanceOf($pathway, Pathway::class);

    actingAs($admin, 'admin');

    livewire(EditAdmission::class, ['record' => $admission->getRouteKey()])
        ->fillForm([
            'name' => 'Test Admission',
            'description' => 'Test Description',
            'pathway' => $pathway->id,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $admission = $admission->fresh();

    Assert::notNull($admission);

    expect($admission->name)->toBe('Test Admission');
});
