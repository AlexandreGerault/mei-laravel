<?php

namespace Tests\Admin\AdmissionResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\AdmissionResource;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;
use Webmozart\Assert\Assert;

test('an admin can list admissions', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(AdmissionResource::getUrl())->assertOk();

    livewire(AdmissionResource\Pages\ListAdmissions::class)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('description')
        ->assertCanRenderTableColumn('pathway.name');
});
