<?php

namespace Admin\Resources\DisciplineResource\Pages;

use Admin\Resources\DisciplineResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Actions\BaseAction;

class EditDiscipline extends EditRecord
{
    protected static string $resource = DisciplineResource::class;

    /**
     * @return array<array-key, BaseAction>
     *
     * @throws \Exception
     */
    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
