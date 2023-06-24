<?php

namespace Admin\Resources\AdminResource\Pages;

use Admin\Resources\AdminResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Actions\BaseAction;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    /**
     * @return array<array-key, BaseAction>
     *
     * @throws \Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
