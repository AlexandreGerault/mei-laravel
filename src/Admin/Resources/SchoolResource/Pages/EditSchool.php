<?php

namespace Admin\Resources\SchoolResource\Pages;

use Admin\Resources\SchoolResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Actions\BaseAction;

class EditSchool extends EditRecord
{
    protected static string $resource = SchoolResource::class;

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
