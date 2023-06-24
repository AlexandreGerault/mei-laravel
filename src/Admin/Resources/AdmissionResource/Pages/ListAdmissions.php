<?php

namespace Admin\Resources\AdmissionResource\Pages;

use Admin\Resources\AdmissionResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Actions\BaseAction;
use Filament\Tables\Actions\DeleteAction;

class ListAdmissions extends ListRecords
{
    protected static string $resource = AdmissionResource::class;

    /**
     * @return array<array-key, BaseAction>
     *
     * @throws \Exception
     */
    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    /**
     * @return array<array-key, BaseAction>
     *
     * @throws \Exception
     */
    protected function getTableActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
