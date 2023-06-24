<?php

namespace Admin\Resources\PathwayResource\Pages;

use Admin\Resources\PathwayResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Actions\BaseAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;

class ListPathways extends ListRecords
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
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
