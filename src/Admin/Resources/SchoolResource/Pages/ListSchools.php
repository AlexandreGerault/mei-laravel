<?php

namespace Admin\Resources\SchoolResource\Pages;

use Admin\Resources\SchoolResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Actions\BaseAction;
use Filament\Tables\Actions\DeleteAction;

class ListSchools extends ListRecords
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
