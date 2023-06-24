<?php

namespace Admin\Resources\AdminResource\Pages;

use Admin\Resources\AdminResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
