<?php

namespace Admin\Resources\AdminResource\Pages;

use Admin\Resources\AdminResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Actions\BaseAction;

class ListAdmins extends ListRecords
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
            Actions\CreateAction::make(),
        ];
    }
}
