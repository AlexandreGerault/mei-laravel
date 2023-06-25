<?php

namespace Admin\Resources\SpecialismResource\Pages;

use Admin\Resources\SpecialismResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Actions\BaseAction;
use Filament\Tables\Actions\DeleteAction;

class ListSpecialisms extends ListRecords
{
    protected static string $resource = SpecialismResource::class;

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
