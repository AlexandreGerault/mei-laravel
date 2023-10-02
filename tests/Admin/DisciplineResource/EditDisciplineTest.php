<?php

namespace Tests\Admin\DisciplineResource;

use Admin\Infrastructure\Factories\AdminFactory;
use Admin\Infrastructure\Models\Admin;
use Admin\Resources\DisciplineResource\Pages\EditDiscipline;
use Shared\Infrastructure\Laravel\Eloquent\Factories\DisciplineFactory;
use Shared\Infrastructure\Laravel\Eloquent\Models\Discipline;
use Webmozart\Assert\Assert;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

test('an admin can edit a discipline', function () {
    $admin = AdminFactory::new()->create();
    $discipline = DisciplineFactory::new()->create();

    Assert::isInstanceOf($admin, Admin::class);
    Assert::isInstanceOf($discipline, Discipline::class);

    actingAs($admin, 'admin');

    livewire(EditDiscipline::class, ['record' => $discipline->getRouteKey()])
        ->fillForm([
            'name' => 'Test Discipline',
            'color' => '#ffffff',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $discipline = $discipline->fresh();

    Assert::notNull($discipline);

    expect($discipline->name)->toBe('Test Discipline');
});
