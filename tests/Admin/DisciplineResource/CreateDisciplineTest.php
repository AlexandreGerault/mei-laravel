<?php

namespace Tests\Admin\DisciplineResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\DisciplineResource;
use Admin\Resources\DisciplineResource\Pages\CreateDiscipline;
use Shared\Infrastructure\Laravel\Eloquent\Models\Discipline;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('an admin can create a discipline', function () {
    $admin = AdminFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);

    actingAs($admin, 'admin');

    get(DisciplineResource::getUrl('create'))->assertOk();

    livewire(CreateDiscipline::class)
        ->fillForm([
            'name' => 'Test Discipline',
            'color' => '#000000',
            'description' => 'Test Description',
        ])
        ->call('create')
        ->assertHasNoErrors();

    expect(Discipline::where('name', 'Test Discipline')->exists())->toBeTrue();
});
