<?php

namespace Admin\Resources\PathwayResource\Pages;

use Admin\Resources\PathwayResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPathway extends EditRecord
{
    protected static string $resource = PathwayResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
