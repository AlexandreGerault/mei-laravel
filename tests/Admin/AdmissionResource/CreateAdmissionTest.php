<?php

namespace Tests\Admin\AdmissionResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\AdmissionResource;
use Admin\Resources\AdmissionResource\Pages\CreateAdmission;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Shared\Infrastructure\Laravel\Eloquent\Factories\PathwayFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Admission;
use Shared\Infrastructure\Laravel\Eloquent\Models\Pathway;
use Webmozart\Assert\Assert;

test('an admin can create an admission', function () {
    $admin = AdminFactory::new()->create();
    $pathway = PathwayFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($pathway, Pathway::class);

    actingAs($admin, 'admin');

    get(AdmissionResource::getUrl('create'))->assertOk();

    livewire(CreateAdmission::class)
        ->fillForm([
            'name' => 'Test Admission',
            'description' => 'Test Description',
            'pathway' => $pathway->id,
        ])
        ->call('create')
        ->assertHasNoErrors();

    expect(Admission::where('name', 'Test Admission')->exists())->toBeTrue();
});
