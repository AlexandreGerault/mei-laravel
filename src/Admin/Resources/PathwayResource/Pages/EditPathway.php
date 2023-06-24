<?php

namespace Admin\Resources\PathwayResource\Pages;

use Admin\Resources\PathwayResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Actions\BaseAction;

class EditPathway extends EditRecord
{
    protected static string $resource = PathwayResource::class;

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
